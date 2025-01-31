# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.6.0 - TBD

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.5.1 - 2018-05-31

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zfcampus/zf-mvc-auth#143](https://github.com/zfcampus/zf-mvc-auth/pull/143) provides an update to `Laminas\ApiTools\MvcAuth\Factory\OAuth2ServerFactory` to allow the `api-tools-oauth2.options.use_openid_connect`
  option (or adapter-specific setting `options.use_openid_connect`) to vary which class is used for an
  `authorization_code` grant type. If the setting is present and a boolean `true` value, the class
  `OAuth2\OpenID\GrantType\AuthorizationCode` will be used instead of `OAuth2\GrantType\AuthorizationCode`.

## 1.5.0 - 2018-05-02

### Added

- [zfcampus/zf-mvc-auth#137](https://github.com/zfcampus/zf-mvc-auth/pull/137) adds support for laminas-permissions-rbac 3.0.

- [zfcampus/zf-mvc-auth#137](https://github.com/zfcampus/zf-mvc-auth/pull/137) adds support for PHP 7.1 and 7.2.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- [zfcampus/zf-mvc-auth#137](https://github.com/zfcampus/zf-mvc-auth/pull/137) removes support for HHVM.

### Fixed

- [zfcampus/zf-mvc-auth#136](https://github.com/zfcampus/zf-mvc-auth/pull/136) provides changes to the `OAuth2Adapter` that prevent hitting
  the database twice when the token is valid.

## 1.4.3 - 2016-09-30

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zfcampus/zf-mvc-auth#128](https://github.com/zfcampus/zf-mvc-auth/pull/128) fixes an issue
  stemming from changes in the Admin API; controller service names are often
  written in configuration using dash, versus namespace, separators, which
  causes authorization lookups to fail. This version now converts dashes to
  namespace separators in the controller names when creating the ACL.

## 1.4.2 - 2016-08-03

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zfcampus/zf-mvc-auth#125](https://github.com/zfcampus/zf-mvc-auth/pull/125) updates the
  `MvcRouteListener` to trigger events using `triggerEventUntil()` instead
  of using argument overloading on `trigger()`; this change ensures that the
  code will work with laminas-eventmanager v3 properly.

## 1.4.1 - 2016-07-25

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zfcampus/zf-mvc-auth#120](https://github.com/zfcampus/zf-mvc-auth/pull/120) fixes the
  `Module::onBootstrap()` method to re-introduce attachment of the
  `MvcRouteListener`.
- [zfcampus/zf-mvc-auth#119](https://github.com/zfcampus/zf-mvc-auth/pull/119) fixes a comparisoin
  in `DefaultResourceResolverListener::getIdentifier()` whereby an identifier of
  `0` was incorrectly resulting in matching to a collection request. As
  collections and entities often have different permissions, this could lead to
  potential false-positiive authorization checks.

## 1.4.0 - 2016-07-11

### Added

- [zfcampus/zf-mvc-auth#114](https://github.com/zfcampus/zf-mvc-auth/pull/114) and
  [zfcampus/zf-mvc-auth#116](https://github.com/zfcampus/zf-mvc-auth/pull/116) add support for both
  PHP 7 and version 3 components from Laminas (while retaining
  compatibility for version 2 components).

### Deprecated

- Nothing.

### Removed

- [zfcampus/zf-mvc-auth#116](https://github.com/zfcampus/zf-mvc-auth/pull/116) removes support for
  PHP 5.5.

### Fixed

- Nothing.

## 1.3.2 - 2016-07-11

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zfcampus/zf-mvc-auth#111](https://github.com/zfcampus/zf-mvc-auth/pull/111) adds a check for the
  `unset_refresh_token_after_use` configuration flag when creating an
  `OAuth2\Server` instance, passing it to the instance when discovered.
