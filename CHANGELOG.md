# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.0.2] - 2025-10-07

### Added

- Добавлено поле `image_position` (select) в блок `ImageAndTextContentSection` для выбора позиции изображения
- Добавлена возможность размещать изображение слева или справа от текстового контента в блоке

### Changed

- Обновлен Blade шаблон `image-and-text-content-section.blade.php`: добавлена динамическая логика для позиционирования изображения на основе выбранного значения
- Обновлен метод `fields()` в `ImageAndTextContentSection.php`: добавлено поле select с опциями "Left" и "Right"
- Обновлен метод `with()` в `ImageAndTextContentSection.php`: добавлена передача значения `image_position` в шаблон
- Обновлен массив `$example` в `ImageAndTextContentSection.php`: добавлено значение по умолчанию для preview

### Technical Details

- **Files modified**:
  - `web/app/themes/isiemini/app/Blocks/ImageAndTextContentSection.php`
  - `web/app/themes/isiemini/resources/views/blocks/image-and-text-content-section.blade.php`
- **Field configuration**: Select field с UI=1, default_value='left', choices=['left', 'right']
- **CSS classes**: Динамические Tailwind классы для адаптивного позиционирования (xl:left-1/2, xl:right-1/2, lg:ml-8, lg:mr-8)

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
