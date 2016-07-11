# Laravel json/xml/yaml/csv converter

## Description

Simple json/xml/yaml/csv converter using [laravel-formatter](https://github.com/SoapBox/laravel-formatter) library

Main class - ConverterController provide all of the logic.
Validator - ConverterRequest support some basic form validation.
(Because of not full support of some mimes validation at Laravel needed to write file extension parsing inside controller)
## Requirements

`php >=5.5.9`

## Installation

Copy project to destination folder
`https://github.com/Svyatoy/Laravel-json-xml-yaml-csv-converter.git`

Inside project directory run command
```
php artisan serve
```


## Using
####Routes table

| Method | URI | Description |
|--------|-----------------------------------|-----------------------------------------------------------|------------------------------------------------------------------------------|
| GET | / | I think it's just must be present... |
| GET | form | Get form to choose file and targeted format |
| POST | converter | Convert file |

