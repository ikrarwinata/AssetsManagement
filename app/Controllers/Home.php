<?php

namespace App\Controllers;

use App\Models\Users_account_model;

class Home extends BaseController
{
	protected $maxLoginAttemps = 3;
	protected $maxCaptchaAttemps = 3;
	protected $userModel;

	protected function onLoad()
	{
		$this->userModel = new Users_account_model();
		
	}
	
	public function languange($rdr = NULL){
		$this->setLocale();
		return $this->index($rdr);
	}
	
	public function index($rdr = NULL)
	{
		$this->getLocale();
		$rdr = ($rdr == NULL ? urldecode($this->request->getGetPost("redirect")) : urldecode($rdr));
		if($rdr!=NULL){
			return redirect()->to("/".base64_decode($rdr));
		}

		if (session()->has("keepalive")) {
			if (session("keepalive") == 1) {
				if (session()->has("username") && session()->has("password")) {
					if (session("username") != NULL && session("password") != NULL) {
						return $this->login_auth(session("username"), session("password"));
					}
				}
			}
		}

		return $this->login();
	}

	protected function loginAttemps()
	{
		$result = 0;
		if (session()->has("loginAttemps")) $result = session("loginAttemps");
		if ($result == NULL || $result <= 0) $result = 0;
		return $result;
	}

	protected function captchaAttemps()
	{
		$result = 0;
		if (session()->has("captchaAttemps")) $result = session("captchaAttemps");
		if ($result == NULL || $result <= 0) $result = 0;
		return $result;
	}

	public function login()
	{
		$locale = $this->getLocale();
		if (session()->has("isBlocked") && session("isBlocked") != NULL) return view("blocked", ["locale" => $locale]);
		if ($this->captchaAttemps() > $this->maxCaptchaAttemps) return $this->blockIp();
		if ($this->loginAttemps() > $this->maxLoginAttemps) return $this->reCaptcha();
		return view("login", ["locale" => $locale]);
	}

	public function login_auth()
	{
		$locale = $this->getLocale();
		if (session()->has("isBlocked") && session("isBlocked") != NULL) return view("blocked", ["locale" => $locale]);
		if ($this->captchaAttemps() >= $this->maxCaptchaAttemps) return $this->blockIp();
		if ($this->loginAttemps() > $this->maxLoginAttemps) return $this->reCaptcha();
		$username = $this->request->getPost('am_username');
		$password = $this->request->getPost('am_password');

		if ($password != NULL && $username != NULL) {
			$logedIn = $this->userModel->where(['username' => $username, 'password' => md5($password)])->first();
			if ($logedIn) {
				session()->set("loginAttemps", 0);
				$sessData = [];
				foreach ($logedIn as $key => $value) {
					$sessData[$key] = $value;
				}
				session()->set($sessData);
				switch ($logedIn->level) {
					case 'superadministrator':
						session()->set('levelCaption', 'Super Administrator');
						return redirect()->to("/superadministrator/Dashboard");
						break;
					case 'admin':
						session()->set('levelCaption', 'Administrator');
						return redirect()->to("/administrator/Dashboard");
						break;
					case 'user':
						session()->set('levelCaption', 'User');
						return redirect()->to("/user/Dashboard");
						break;
					default:
						session()->setFlashdata('ci_login_flash_message', lang('Errors.InvalidLoginData', [], $locale));
						session()->setFlashdata('ci_login_flash_message_type', 'error');
						return redirect()->to("/Home/login");
						break;
				}
			}
			session()->set("loginAttemps", $this->loginAttemps() + 1);
			if ($this->loginAttemps() >= $this->maxLoginAttemps) return $this->reCaptcha();
		};
		session()->setFlashdata('ci_login_flash_message', lang('Errors.LoginFailed', [], $locale));
		session()->setFlashdata('ci_login_flash_message_type', 'error');
		return view("login", ["locale" => $locale]);
	}

	public function reCaptcha()
	{
		if ($this->captchaAttemps() >= $this->maxCaptchaAttemps) return $this->blockIp();
		$captchainput = $this->request->getPost('captcha');
		if ($captchainput != NULL) {
			$captchainput = str_replace(" ", NULL, $captchainput);
			if ($captchainput == session("captcha")) {
				session()->set("loginAttemps", 0);
				session()->set("captchaAttemps", $this->captchaAttemps() + 1);
				session()->remove("captcha");
				return redirect()->to("/Home/login");
			}
		}
		$randText = "";
		for ($i = 0; $i < 4; $i++) {
			$type = mt_rand(1, 4);
			switch ($type) {
				case 1:
					$randText .= mt_rand(0, 9); // Angka
					break;
				case 2:
					$randText .= chr(mt_rand(65, 90)); // Alfabet
					break;
				case 3:
					$randText .= chr(mt_rand(97, 122)); // Kapital Alfabet
					break;
				case 4:
					$randText .= chr(mt_rand(65, 90)); // Alfabet
					break;
				default:
					$randText .= mt_rand(0, 9); // Angka
					break;
			}
		}
		session()->set("captcha", $randText);
		return view("captcha", ["locale" => $this->getLocale()]);
		$this->clearSession();
	}

	public function captchaImage()
	{
		if (!session()->has("captcha") || session("captcha") == NULL) return FALSE;

		$captchaText = str_split(session("captcha"), 1);
		$imgHeight = 80;
		$imgWidth = 274;
		$listFont = [
			'fonts/EVAGR.5ANDE.otf',
			'fonts/ThanksBunnyFree.otf',
		];

		$baseImg = imagecreate($imgWidth, $imgHeight);
		imagecolorallocate($baseImg, 69, 179, 157); // base color

		$bgR = mt_rand(100, 180);
		$bgG = mt_rand(100, 180);
		$bgB = mt_rand(100, 180);
		$R = abs(255 - $bgR);
		$G = abs(255 - $bgG);
		$B = abs(255 - $bgB);
		$noise_color = imagecolorallocate($baseImg, $R, $G, $B);
		for ($i = 0; $i < ($imgWidth * $imgHeight) / 3; $i++) {
			imagefilledellipse($baseImg, mt_rand(0, $imgWidth), mt_rand(0, $imgHeight), 3, rand(2, 5), $noise_color);
		}
		imagecolorallocate($baseImg, 240, 240, 240); // overlay
		$maxTol = mt_rand(-75, 75);
		$minTol = 35;
		if ($maxTol >= 0) {
			if ($maxTol <= $minTol) $maxTol = $minTol;
		} else {
			if ($maxTol >= ($minTol * -1)) $maxTol = $minTol * -1;
		}
		$R += $maxTol;
		$G += $maxTol;
		$B += $maxTol;
		$textColor = imagecolorallocate($baseImg, $R, $G, $B);
		$font = $listFont[mt_rand(0, (count($listFont) - 1))];
		$lastX = mt_rand(23, 33);
		foreach ($captchaText as $key => $value) {
			$fontSize = mt_rand(27, 34);
			$angle = mt_rand(-40, 40);
			$lastX += abs($angle) * 0.30;
			imagefttext($baseImg, $fontSize, $angle, $lastX, mt_rand(45, 67), $textColor, $font, $value);
			$lastX += $fontSize + mt_rand(15, 30);
		}
		header("Content-type: image/png");
		imagepng($baseImg);
		imagedestroy($baseImg);
	}

	public function blockIp()
	{;
		session()->set("captchaAttemps", 0);
		session()->set("isBlocked", $this->request->getIPAddress());
		session()->set("blockTime", strtotime("now"));
		session()->set("blockTimeout", 20000); // lebih 4 Jam
		session()->remove("captcha");
		$this->clearSession();
		return $this->login();
	}

	private function clearSession()
	{
		session()->remove("levelCaption");
		session()->remove("loginAttemps");
		session()->remove("login");
		session()->remove("login_name");
		session()->remove("keepalive");

		session()->remove($this->userModel->getFields());
		return TRUE;
	}

	public function logout()
	{
		$this->clearSession();
		return redirect()->to("/Home/login");
	}
}
