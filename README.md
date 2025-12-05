# This is my package filament-table-in-a-schema

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dave-mills/filament-table-in-a-schema.svg?style=flat-square)](https://packagist.org/packages/dave-mills/filament-table-in-a-schema)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/dave-mills/filament-table-in-a-schema/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/dave-mills/filament-table-in-a-schema/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/dave-mills/filament-table-in-a-schema/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/dave-mills/filament-table-in-a-schema/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dave-mills/filament-table-in-a-schema.svg?style=flat-square)](https://packagist.org/packages/dave-mills/filament-table-in-a-schema)


Have you ever wanted to put a Filament Table inside a Schema? Now you can, without the hassle of trying to remember how custom Livewire schema components work. 

This package does 1 thing - it gives you a new `TableInSchema` schema component that you can use inside any of your forms or infolists. 

## Installation

You can install the package via composer:

```bash
composer require dave-mills/filament-table-in-a-schema
```

## Usage

The `TableInSchema` component can be used inside any Filament form or infolist schema. Here is an example of how to use it in a form:

```php
use DaveMills\FilamentTableInASchema\Components\TableInSchema;

class YourResourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Other form components... e.g.:
                TextInput::make('start_offset')
                    ->required()
                    ->numeric(),
                TableInSchama::make()
                ->table(fn(Table $table): Table => $table
                    ->query(fn () => YourModel::query())
                    ->columns([
                        // ... your columns here ...
                    ])
                    ->filters([
                        // ... your filters here ...
                    ])
                    ->recordActions([
                        // ... your record actions here ...
                    ])
                    // any other table configuration methods                    
                )
            ]);
    }
}
```
That's it! You now have a fully functional Filament Table inside your form or infolist schema.

## Useful Information

- The `TableInSchema` component must include a `->table()` method call. This method accepts a closure that receives a `Table` instance, which you can configure just like any other Filament Table. This _must_ be a closure; you can't pass a pre-configured Table instance, or array of columns, etc.

- The component has no "state" of its own, so you cannot pass state to it in the same way as your other form or infolist components. It doesn't affect the form's data, and it doesn't submit any data itself. It is purely a display component. If you need the table to save data with the form submission, you're probably better off using a Repeater component. 

- Because it doesn't have state from the Schema, the table doesn't automatically inherit context from the form or infolist. It doesn't know about the current resource's `$record`, for example. You need to tell the table explicitly what to render using `->query()` or `->relationship()`, just as you would with a Filament table on a custom page. For example: 

```php

// Assuming the current page has a `getRecord()` method, and you want the table to show related entries:
TableInSchema::make()
->table(fn (Table $table): Table => $table
->relationship(fn () -> $this->getRecord()->yourRelationship())
// ... other table configuration ...
)

```


- Any actions you add to the table will work as normal, e.g. `Create`, `Edit`, `Delete` actions. Those will act independently of the form or infolist that contains the table. 


## Other examples

Example of re-using an existing table definition: 

```php
use DaveMills\FilamentTableInASchema\Components\TableInSchema;

class YourResourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Other form components...
                TableInSchama::make()
                ->table(fn(Table $table): Table => AnotherResourceTable::configure($table))
            ]);
    }
}

class AnotherResourceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(fn () => AnotherModel::query())
            ->columns([
                // ... your columns here ...
            ])
            ->filters([
                // ... your filters here ...
            ])
            ->recordActions([
                // ... your record actions here ...
            ]);
    }
}

```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Dave Mills](https://github.com/dave-mills)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
