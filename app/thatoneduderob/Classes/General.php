<?php
  namespace thatoneduderob\Classes;

  class General {
    public function getDateFromStamp($timestamp, $app) {
      $date = new \DateTime($timestamp, new \DateTimeZone(($app->auth ? $app->auth->timezone : "America/New_York")));
      return $date->format("M d, Y");
    }

    public function getTimeFromStamp($timestamp, $app) {
      $userTimezone = new \DateTimeZone(($app->auth ? $app->auth->timezone : $app->websettings->getTimezone()));

      $date = new \DateTime($timestamp);
      $date->setTimezone($userTimezone);
      $date->format("h:ia (e)");

      return $date->format("h:ia (e)");
    }

    public function getTimezones() {
      return \DateTimeZone::listIdentifiers();
    }
  }