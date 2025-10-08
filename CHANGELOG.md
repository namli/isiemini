# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.0.2] - 2025-10-07

### Added

- Добавлен блок `TitleSubtitleText` с полями: title, subtitle, text (WYSIWYG), button (опционально)
- Добавлено поле `alignment` (select) в блок `TitleSubtitleText` для выбора выравнивания контента (Left / Center / Right)
- Добавлено поле `image_position` (select) в блок `ImageAndTextContentSection` для выбора позиции изображения
- Добавлена возможность размещать изображение слева или справа от текстового контента в блоке

### Changed

- Блок `TitleSubtitleText`: все поля опциональны, кнопка отображается только при заполнении `button_text`
- Блок `TitleSubtitleText`: поле `text` использует WYSIWYG редактор с базовым toolbar и без media buttons
- Блок `TitleSubtitleText`: добавлена динамическая логика выравнивания (text-left/center/right, justify-start/center/end)
- Обновлен Blade шаблон `title-subtitle-text.blade.php`: использует `match()` для определения CSS классов выравнивания
- Обновлен Blade шаблон `image-and-text-content-section.blade.php`: добавлена динамическая логика для позиционирования изображения на основе выбранного значения
- Обновлен метод `fields()` в `ImageAndTextContentSection.php`: добавлено поле select с опциями "Left" и "Right"
- Обновлен метод `with()` в `ImageAndTextContentSection.php`: добавлена передача значения `image_position` в шаблон
- Обновлен массив `$example` в `ImageAndTextContentSection.php`: добавлено значение по умолчанию для preview

### Fixed

- Исправлена проблема отображения кнопки в preview блока `TitleSubtitleText` когда значения не указаны (убраны значения кнопки из массива `$example`)

### Technical Details

- **Files modified**:
  - `web/app/themes/isiemini/app/Blocks/TitleSubtitleText.php`
  - `web/app/themes/isiemini/resources/views/blocks/title-subtitle-text.blade.php`
  - `web/app/themes/isiemini/app/Blocks/ImageAndTextContentSection.php`
  - `web/app/themes/isiemini/resources/views/blocks/image-and-text-content-section.blade.php`
- **TitleSubtitleText**: Category='iesemini-theme', supports=[mode, multiple, jsx, background]
- **TitleSubtitleText alignment**: Select field с default_value='center', choices=['left', 'center', 'right']
- **TitleSubtitleText text field**: WYSIWYG с tabs=['text', 'visual'], toolbar='basic', media_buttons=false
- **ImageAndTextContentSection**: Select field с UI=1, default_value='left', choices=['left', 'right']
- **CSS classes**: Динамические Tailwind классы для адаптивного позиционирования

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
