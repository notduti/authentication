<?php

    class User {

        private ?String $userId = null;
        private ?String $hashedPassword = null;
        private ?String $salt = null;
        private ?String $token = null;
        private int $expire = 0;
        private int $validFrom = 0;

        public function __construct(?String $userId, ?String $hashedPassword, ?String $salt, 
            ?String $token, int $expire, int $validFrom) {

            $this->userId = $userId;
            $this->hashedPassword = $hashedPassword;
            $this->salt = $salt;
            $this->token = $token;
            $this->expire = $expire;
            $this->validFrom = $validFrom;
        }

        public function getUserId(): ?String {

            return $this->userId;
        }
        public function getHashedPassword(): ?String {

            return $this->hashedPassword;
        }
        public function getSalt(): ?String {

            return $this->salt;
        }
        public function getToken(): ?String {

            return $this->token;
        }
        public function getExpire(): int {

            return $this->expire;
        }
        public function getValidFrom(): int {

            return $this->validFrom;
        }



        public function setUserId(?String $userId): void {

            $this->userId = $userId;
        }
        public function setHashedPassword(?String $hashedPassword): void {

            $this->hashedPassword = $hashedPassword;
        }
        public function setSalt(?String $salt): void {

            $this->salt = $salt;
        }
        public function setToken(?String $token): void {

            $this->token = $token;
        }
        public function setExpire(int $expire): void {

            $this->expire = $expire;
        }
        public function setValidFrom(int $validFrom): void {

            $this->validFrom = $validFrom;
        }

        public function __toString(): String {

            return "userId: " . $this->userId .
            "\nhashedPassword: " . $this->hashedPassword .
            "\nsalt: " . $this->salt .
            "\ntoken: " . $this->token .
            "\nexpire: " . $this->expire .
            "\nvalidFrom: " . $this->validFrom;
        }
    }
?>