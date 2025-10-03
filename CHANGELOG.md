# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.0.1] - 2025-10-03

### Added

- Добавлен Alpine.js для интерактивных компонентов (v3.x)
- Добавлена функциональность открытия/закрытия мобильного меню
- Добавлен CSS стиль `[x-cloak]` для предотвращения мигания элементов до загрузки Alpine.js

### Changed

- Обновлен `header.blade.php`: добавлены Alpine директивы (`x-data`, `x-show`, `@click`, `x-cloak`) для управления мобильным меню
- Обновлен `app.js`: подключен и инициализирован Alpine.js
- Обновлен `app.css`: добавлено правило для скрытия элементов с атрибутом `x-cloak`

### Fixed

- Исправлена проблема с нерабочими кнопками открытия/закрытия мобильного меню в header
- Мобильное меню теперь корректно открывается и закрывается при клике на кнопки
- Мобильное меню закрывается при клике на backdrop (затемненную область)

### Technical Details

- **Package**: `alpinejs` установлен как зависимость
- **Files modified**:
  - `web/app/themes/isiemini/resources/js/app.js`
  - `web/app/themes/isiemini/resources/views/sections/header.blade.php`
  - `web/app/themes/isiemini/resources/css/app.css`
  - `web/app/themes/isiemini/package.json`
