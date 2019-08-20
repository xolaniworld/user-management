<?php
namespace Application;


class AuthTransaction
{
    private $session;
    private $cookie;
    private $useCookiesSettings;

    public function __construct(Session $session, Cookie $cookie, $useCookiesSettings = null)
    {
        $this->session = $session;
        $this->cookie = $cookie;
        $this->useCookiesSettings = $useCookiesSettings;
    }

    public function logout()
    {
        $this->session->reset();

        if ($this->useCookiesSettings) {
            $params = $this->session->getCookieParams();
            $this->cookie->set($this->session->getName(), '', time() - 60 * 60,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        $this->session->remove('login');
        $this->session->destroy();
    }
}