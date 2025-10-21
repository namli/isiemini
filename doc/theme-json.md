# Документация theme.json

## Обзор

`theme.json` — это центральный файл конфигурации WordPress темы (доступен начиная с версии 5.8). Он позволяет централизованно управлять настройками темы, стилями и доступными опциями в редакторе блоков.

### ⚡ Важно: Где применяются стили из theme.json?

**`theme.json` влияет НА ОБА места:**

1. **В редакторе блоков** (WordPress Admin) — редакторы видят стили при создании контента
2. **На frontend** (что видят пользователи сайта) — те же стили применяются к опубликованному контенту

**Это главное преимущество** `theme.json` — он обеспечивает **полное соответствие** между тем, что видит редактор и тем, что увидит посетитель сайта. Больше никаких сюрпризов типа "в редакторе выглядит хорошо, а на сайте по-другому"!

## Расположение файлов

- **Исходный файл:** `/web/app/themes/isiemini/theme.json`
- **Скомпилированный файл:** `/web/app/themes/isiemini/public/build/assets/theme.json`

> **Важно:** Исходный файл препроцессируется через Vite и компилируется в `public/build/assets/theme.json`. После изменений необходимо запустить build процесс.

## Основная структура

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    // Настройки доступных опций в редакторе
  },
  "styles": {
    // Применяемые стили к элементам и блокам
  }
}
```

### Секция `settings`

Определяет, **ЧТО доступно** в редакторе блоков (палитры цветов, шрифты, размеры и т.д.).

**Применяется:** Только в редакторе (определяет доступные опции в UI).

### Секция `styles`

Определяет, **КАК стилизованы** элементы (глобальные стили для кнопок, ссылок, заголовков и блоков).

**Применяется:** И в редакторе, И на frontend (визуальные стили).

---

## Механизм работы

### Как WordPress использует theme.json:

1. **При загрузке редактора:**
   - WordPress читает `theme.json`
   - Применяет стили из секции `styles` к iframe редактора
   - Показывает доступные опции из секции `settings` в панелях настроек
2. **При рендеринге frontend:**

   - WordPress генерирует CSS из секции `styles`
   - Добавляет эти стили в `<head>` страницы
   - Пользователи видят ТЕ ЖЕ стили, что и в редакторе

3. **Генерация CSS переменных:**
   - WordPress создает CSS переменные из всех preset'ов (цвета, шрифты, размеры)
   - Эти переменные доступны и в редакторе, и на frontend
   - Можно использовать в своих CSS файлах

### Пример генерируемых стилей:

Если в `theme.json` определено:

```json
{
  "styles": {
    "elements": {
      "button": {
        "color": {
          "background": "#786c6c"
        }
      }
    }
  }
}
```

WordPress сгенерирует CSS:

```css
/* Для frontend */
.wp-element-button,
.wp-block-button__link {
  background-color: #786c6c;
}

/* Для редактора (в iframe) */
.editor-styles-wrapper .wp-element-button,
.editor-styles-wrapper .wp-block-button__link {
  background-color: #786c6c;
}
```

---

## Настройка цветов

### Добавление палитры цветов

Цвета определяются в `settings.color.palette`:

```json
{
  "settings": {
    "color": {
      "custom": false,
      "defaultPalette": false,
      "palette": [
        {
          "name": "Primary",
          "slug": "primary",
          "color": "#786c6c"
        },
        {
          "name": "Primary Dark",
          "slug": "primary-dark",
          "color": "#4d4647"
        },
        {
          "name": "Secondary",
          "slug": "secondary",
          "color": "#e85454"
        },
        {
          "name": "White",
          "slug": "white",
          "color": "#ffffff"
        },
        {
          "name": "Black",
          "slug": "black",
          "color": "#000000"
        }
      ]
    }
  }
}
```

### Генерируемые CSS переменные

WordPress автоматически создаст CSS переменные на основе `slug`:

- `--wp--preset--color--primary` → `#786c6c`
- `--wp--preset--color--primary-dark` → `#4d4647`
- `--wp--preset--color--secondary` → `#e85454`
- `--wp--preset--color--white` → `#ffffff`
- `--wp--preset--color--black` → `#000000`

### Использование цветов в CSS

```css
.my-element {
  background-color: var(--wp--preset--color--primary);
  color: var(--wp--preset--color--white);
}

.my-button:hover {
  background-color: var(--wp--preset--color--primary-dark);
}
```

---

## Настройка типографики

### Размеры шрифтов

```json
{
  "settings": {
    "typography": {
      "defaultFontSizes": false,
      "customFontSize": false,
      "fontSizes": [
        {
          "name": "Small",
          "slug": "small",
          "size": "0.875rem"
        },
        {
          "name": "Medium",
          "slug": "medium",
          "size": "1rem"
        },
        {
          "name": "Large",
          "slug": "large",
          "size": "1.25rem"
        },
        {
          "name": "Extra Large",
          "slug": "x-large",
          "size": "2rem"
        }
      ]
    }
  }
}
```

### Генерируемые переменные

- `--wp--preset--font-size--small` → `0.875rem`
- `--wp--preset--font-size--medium` → `1rem`
- `--wp--preset--font-size--large` → `1.25rem`
- `--wp--preset--font-size--x-large` → `2rem`

### Семейства шрифтов

```json
{
  "settings": {
    "typography": {
      "fontFamilies": [
        {
          "name": "Sans Serif",
          "slug": "sans",
          "fontFamily": "system-ui, -apple-system, sans-serif"
        },
        {
          "name": "Serif",
          "slug": "serif",
          "fontFamily": "Georgia, Cambria, serif"
        },
        {
          "name": "Monospace",
          "slug": "mono",
          "fontFamily": "Consolas, Monaco, monospace"
        }
      ]
    }
  }
}
```

---

## Стилизация элементов

### Кнопки (wp-element-button)

Секция `styles.elements.button` применяет стили к кнопкам (классы `.wp-element-button` и `.wp-block-button__link`):

```json
{
  "styles": {
    "elements": {
      "button": {
        "color": {
          "background": "var(--wp--preset--color--primary)",
          "text": "var(--wp--preset--color--white)"
        },
        "border": {
          "radius": "6px",
          "width": "0px"
        },
        "spacing": {
          "padding": {
            "top": "10px",
            "right": "20px",
            "bottom": "10px",
            "left": "20px"
          }
        },
        "typography": {
          "fontSize": "1rem",
          "fontWeight": "600"
        },
        ":hover": {
          "color": {
            "background": "var(--wp--preset--color--primary-dark)",
            "text": "var(--wp--preset--color--white)"
          }
        },
        ":focus": {
          "color": {
            "background": "var(--wp--preset--color--primary-dark)"
          }
        },
        ":active": {
          "color": {
            "background": "var(--wp--preset--color--primary-dark)"
          }
        }
      }
    }
  }
}
```

### Ссылки

```json
{
  "styles": {
    "elements": {
      "link": {
        "color": {
          "text": "var(--wp--preset--color--primary)"
        },
        "typography": {
          "textDecoration": "none"
        },
        ":hover": {
          "color": {
            "text": "var(--wp--preset--color--primary-dark)"
          },
          "typography": {
            "textDecoration": "underline"
          }
        }
      }
    }
  }
}
```

### Заголовки

```json
{
  "styles": {
    "elements": {
      "heading": {
        "typography": {
          "fontWeight": "700",
          "lineHeight": "1.2"
        },
        "color": {
          "text": "var(--wp--preset--color--primary)"
        }
      },
      "h1": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--3-xl)"
        }
      },
      "h2": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--2-xl)"
        }
      },
      "h3": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--xl)"
        }
      }
    }
  }
}
```

---

## Доступные элементы для стилизации

| Элемент     | CSS селектор                                   | Описание               |
| ----------- | ---------------------------------------------- | ---------------------- |
| `button`    | `.wp-element-button`, `.wp-block-button__link` | Кнопки                 |
| `link`      | `a`                                            | Ссылки                 |
| `heading`   | `h1, h2, h3, h4, h5, h6`                       | Все заголовки          |
| `h1` - `h6` | `h1`, `h2`, и т.д.                             | Конкретные заголовки   |
| `caption`   | `figcaption`                                   | Подписи к изображениям |
| `cite`      | `cite`                                         | Цитаты                 |

---

## Стилизация конкретных блоков

Помимо глобальных элементов, можно стилизовать конкретные блоки WordPress:

```json
{
  "styles": {
    "blocks": {
      "core/button": {
        "color": {
          "background": "var(--wp--preset--color--secondary)",
          "text": "var(--wp--preset--color--white)"
        },
        "border": {
          "radius": "8px"
        }
      },
      "core/heading": {
        "spacing": {
          "margin": {
            "bottom": "1.5rem"
          }
        }
      },
      "core/paragraph": {
        "spacing": {
          "margin": {
            "bottom": "1rem"
          }
        }
      }
    }
  }
}
```

---

## Глобальные стили

Базовые стили для всего сайта:

```json
{
  "styles": {
    "color": {
      "background": "#ffffff",
      "text": "#000000"
    },
    "typography": {
      "fontFamily": "var(--wp--preset--font-family--sans)",
      "fontSize": "var(--wp--preset--font-size--medium)",
      "lineHeight": "1.6"
    },
    "spacing": {
      "padding": {
        "top": "0px",
        "right": "0px",
        "bottom": "0px",
        "left": "0px"
      }
    }
  }
}
```

---

## Настройка Layout

```json
{
  "settings": {
    "layout": {
      "contentSize": "48rem",
      "wideSize": "80rem"
    }
  }
}
```

- `contentSize` — максимальная ширина обычного контента
- `wideSize` — максимальная ширина для "широких" блоков

---

## Настройка Spacing

```json
{
  "settings": {
    "spacing": {
      "padding": true,
      "margin": true,
      "blockGap": true,
      "units": ["px", "%", "em", "rem", "vw", "vh"]
    }
  }
}
```

---

## Пользовательские CSS переменные

В секции `custom` можно определить собственные переменные:

```json
{
  "settings": {
    "custom": {
      "spacing": {
        "small": "1rem",
        "medium": "2rem",
        "large": "3rem"
      },
      "typography": {
        "font-size": {
          "huge": "5rem"
        },
        "line-height": {
          "tight": "1.2",
          "normal": "1.6",
          "loose": "2"
        }
      }
    }
  }
}
```

Эти значения будут доступны как:

- `--wp--custom--spacing--small`
- `--wp--custom--spacing--medium`
- `--wp--custom--typography--font-size--huge`

---

## Псевдоклассы

Поддерживаемые псевдоклассы в `theme.json`:

- `:hover`
- `:focus`
- `:active`
- `:visited` (только для ссылок)

Пример:

```json
{
  "styles": {
    "elements": {
      "button": {
        "color": {
          "background": "#786c6c"
        },
        ":hover": {
          "color": {
            "background": "#4d4647"
          }
        },
        ":focus": {
          "border": {
            "color": "#e85454",
            "width": "2px"
          }
        }
      }
    }
  }
}
```

---

## Полный пример конфигурации

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "layout": {
      "contentSize": "48rem",
      "wideSize": "80rem"
    },
    "color": {
      "custom": false,
      "defaultPalette": false,
      "palette": [
        {
          "name": "Primary",
          "slug": "primary",
          "color": "#786c6c"
        },
        {
          "name": "Primary Dark",
          "slug": "primary-dark",
          "color": "#4d4647"
        },
        {
          "name": "Secondary",
          "slug": "secondary",
          "color": "#e85454"
        },
        {
          "name": "White",
          "slug": "white",
          "color": "#ffffff"
        }
      ]
    },
    "typography": {
      "defaultFontSizes": false,
      "customFontSize": false,
      "fontFamilies": [
        {
          "name": "Sans Serif",
          "slug": "sans",
          "fontFamily": "system-ui, sans-serif"
        }
      ],
      "fontSizes": [
        {
          "name": "Small",
          "slug": "small",
          "size": "0.875rem"
        },
        {
          "name": "Medium",
          "slug": "medium",
          "size": "1rem"
        },
        {
          "name": "Large",
          "slug": "large",
          "size": "1.5rem"
        }
      ]
    },
    "spacing": {
      "padding": true,
      "margin": true,
      "units": ["px", "%", "em", "rem", "vw", "vh"]
    }
  },
  "styles": {
    "color": {
      "background": "#ffffff",
      "text": "#000000"
    },
    "typography": {
      "fontFamily": "var(--wp--preset--font-family--sans)",
      "fontSize": "var(--wp--preset--font-size--medium)",
      "lineHeight": "1.6"
    },
    "elements": {
      "button": {
        "color": {
          "background": "var(--wp--preset--color--primary)",
          "text": "var(--wp--preset--color--white)"
        },
        "border": {
          "radius": "6px"
        },
        "spacing": {
          "padding": {
            "top": "10px",
            "right": "20px",
            "bottom": "10px",
            "left": "20px"
          }
        },
        "typography": {
          "fontSize": "1rem",
          "fontWeight": "600"
        },
        ":hover": {
          "color": {
            "background": "var(--wp--preset--color--primary-dark)"
          }
        }
      },
      "link": {
        "color": {
          "text": "var(--wp--preset--color--primary)"
        },
        ":hover": {
          "color": {
            "text": "var(--wp--preset--color--primary-dark)"
          }
        }
      },
      "h1": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--large)",
          "fontWeight": "700"
        }
      }
    }
  }
}
```

---

## Интеграция с Tailwind CSS

В нашей теме `theme.json` препроцессируется, и цвета/шрифты из Tailwind CSS автоматически включаются в финальный файл. Это означает, что все цвета и размеры Tailwind становятся доступны как CSS переменные WordPress.

---

## Процесс сборки

После изменения `theme.json`:

1. Файл обрабатывается через Vite
2. Tailwind CSS переменные интегрируются
3. Результат сохраняется в `public/build/assets/theme.json`
4. WordPress использует скомпилированную версию

**Команды для сборки:**

```bash
# Development
npm run dev

# Production build
npm run build
```

---

## Отладка

### Проверка сгенерированных CSS переменных

После компиляции откройте DevTools браузера и проверьте элемент `:root`:

```css
:root {
  --wp--preset--color--primary: #786c6c;
  --wp--preset--color--primary-dark: #4d4647;
  --wp--preset--font-size--small: 0.875rem;
  /* и т.д. */
}
```

### Валидация

Используйте JSON Schema для валидации:

```json
"$schema": "https://schemas.wp.org/trunk/theme.json"
```

Это обеспечит автодополнение и проверку в редакторе.

---

## Полезные ссылки

- [Официальная документация WordPress theme.json](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/)
- [theme.json Schema](https://schemas.wp.org/trunk/theme.json)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

---

## Переопределение стилей

### Что если нужны разные стили для редактора и frontend?

Хотя `theme.json` обеспечивает одинаковые стили для обоих мест, иногда нужны различия. Для этого используйте отдельные CSS файлы:

**Для frontend:**

```css
/* resources/css/app.css */
.wp-element-button {
  /* Стили только для frontend */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
```

**Для редактора:**

```css
/* resources/css/editor.css */
.editor-styles-wrapper .wp-element-button {
  /* Стили только для редактора */
  border: 2px dashed #ccc; /* например, показать границы */
}
```

### Приоритет стилей:

1. **Самый низкий:** Стили из `theme.json`
2. **Средний:** Стили из `app.css` (frontend) или `editor.css` (редактор)
3. **Самый высокий:** Inline стили и `!important`

**Рекомендация:** Используйте `theme.json` для базовых стилей, которые должны быть одинаковыми везде, а CSS файлы — для специфичных доработок.

---

## Заключение

`theme.json` обеспечивает:

- ✅ Централизованное управление темой
- ✅ Автоматическую генерацию CSS переменных
- ✅ **Согласованность между редактором и frontend** ⭐
- ✅ Упрощение кастомизации
- ✅ Лучшую производительность

### Ключевое преимущество:

**Все изменения в `theme.json` автоматически применяются КАК в редакторе блоков WordPress, ТАК и на frontend сайта.** Это означает, что контент-менеджеры видят в редакторе именно то, что увидят посетители сайта — никаких сюрпризов после публикации! 🎯
