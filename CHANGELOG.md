# Changelog

All notable changes to `naim886/imgenerate-laravel-faker` will be documented in this file.

## 1.2.0 - 2025-12-03

### Changed
- Extended Laravel support to include Laravel 8.x for broader compatibility
- Extended PHP support to include PHP 7.4+
- Updated testbench to support Orchestra Testbench 6.x+
- Updated PHPUnit to support version 11.x
- Improved package compatibility with older Laravel projects

### Fixed
- Fixed dependency conflict issues when installing in Laravel 8 projects
- Resolved illuminate/support version conflicts

## 1.1.0 - 2025-12-02

### Added
- Full customization support for all imgenerate.com parameters
- Background color (`bg`) customization with hex colors
- Text color (`text_color`) customization with hex colors
- Font size (`font_size`) customization
- Text angle (`angle`) rotation support (0-360 degrees)
- Custom text (`text`) support
- Image format (`format`) support (jpg, png, webp)
- New fluent methods: `bg()`, `textColor()`, `fontSize()`, `angle()`, `text()`, `format()`
- Configuration options for all new parameters
- Environment variable support for defaults
- Updated comprehensive usage examples
- Enhanced documentation in README

### Changed
- Updated `url()` method to accept options array instead of category string
- Updated `save()` method to accept options array
- Updated `download()` method to accept options array
- Updated `multiple()` method to accept options array
- Updated all FakerProvider methods to support options array
- Improved API URL generation to match imgenerate.com format exactly
- Enhanced examples with real-world use cases

### Example
```php
// Generate image with full customization
$url = Imgenerate::url(400, 400, [
    'bg' => '1e3a8a',
    'text_color' => 'ffffff',
    'font_size' => 24,
    'angle' => 0,
    'text' => 'www.imgenerate.com'
]);
```

