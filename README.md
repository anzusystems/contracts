AnzuSystems Contracts
============

---

Provides common interfaces, traits, abstracts, enums and other common functionality used in AnzuSystems' projects.

---

## Installation

```console
$ composer require anzusystems/contracts
```

### Common Interfaces and related Traits or Abstract classes.

* [BaseIdentifiableInterface](src/Entity/Interfaces/BaseIdentifiableInterface.php) - [NamedResourceTrait](src/Entity/Traits/NamedResourceTrait.php)
    * [IdentifiableInterface](src/Entity/Interfaces/IdentifiableInterface.php) - [IdentityTrait](src/Entity/Traits/IdentityTrait.php)
    * [UuidIdentifiableInterface](src/Entity/Interfaces/UuidIdentifiableInterface.php)
* [CopyableInterface](src/Entity/Interfaces/CopyableInterface.php)
* [IndexableInterface](src/Entity/Interfaces/IndexableInterface.php)
* [EnableInterface](src/Entity/Interfaces/EnableInterface.php) - [EnableTrait](src/Entity/Traits/EnableTrait.php)
* [TimeTrackingInterface](src/Entity/Interfaces/TimeTrackingInterface.php) - [TimeTrackingTrait](src/Entity/Traits/TimeTrackingTrait.php)
* [UserTrackingInterface](src/Entity/Interfaces/UserTrackingInterface.php)
* [ValueObjectInterface](src/Model/ValueObject/ValueObjectInterface.php) - [AbstractValueObject](src/Model/ValueObject/AbstractValueObject.php)
* [EnumInterface](src/Model/Enum/EnumInterface.php) - [BaseEnumTrait](src/Model/Enum/BaseEnumTrait.php)
* [DocumentInterface](src/Document/Interfaces/DocumentInterface.php) - [DocumentTrait](src/Document/Traits/DocumentTrait.php)
* [CacheSettingsInterface](src/Response/Cache/CacheSettingsInterface.php) - [AbstractCacheSettings](src/Response/Cache/AbstractCacheSettings.php)
---

### Abstracts and common functionality

* [AnzuApp](src/AnzuApp.php)
* [AnzuUser](src/Entity/AnzuUser.php)

### Exception

* [AnzuException](src/Exception/AnzuException.php)
* [AppReadOnlyModeException](src/Exception/AppReadOnlyModeException.php)

### Enums

* [LogLevel](src/Model/Enum/LogLevel.php)

More details on how to use Enums in AnzuSystems projects can be found [here](src/Resources/doc/enums.md).
