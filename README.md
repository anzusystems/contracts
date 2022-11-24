AnzuSystems Contracts
============

Provides common interfaces, traits, abstracts, enums and other common functionality used in AnzuSystems' projects.

---

## Installation

```console
$ composer require anzusystems/contracts
```

### Common Interfaces and related Traits or Abstract classes.

* [BaseIdentifiableInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/BaseIdentifiableInterface.php) - [NamedResourceTrait](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Traits/NamedResourceTrait.php)
    * [IdentifiableInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/IdentifiableInterface.php) - [IdentityTrait](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Traits/IdentityTrait.php)
    * [UuidIdentifiableInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/UuidIdentifiableInterface.php)
* [CopyableInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/CopyableInterface.php)
* [IndexableInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/IndexableInterface.php)
* [EnableInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/EnableInterface.php) - [EnableTrait](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Traits/EnableTrait.php)
* [TimeTrackingInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/TimeTrackingInterface.php) - [TimeTrackingTrait](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Traits/TimeTrackingTrait.php)
* [UserTrackingInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/Interfaces/UserTrackingInterface.php)
* [ValueObjectInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Model/ValueObject/ValueObjectInterface.php) - [AbstractValueObject](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Model/ValueObject/AbstractValueObject.php)
* [EnumInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Model/Enum/EnumInterface.php) - [BaseEnumTrait](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Model/Enum/BaseEnumTrait.php)
* [DocumentInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Document/Interfaces/DocumentInterface.php) - [DocumentTrait](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Document/Traits/DocumentTrait.php)
* [CacheSettingsInterface](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Response/Cache/CacheSettingsInterface.php) - [AbstractCacheSettings](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Response/Cache/AbstractCacheSettings.php)
---

### Abstracts and common functionality

* [AnzuApp](https://github.com/anzusystems/contracts/blob/main/src?path=/src/AnzuApp.php)
* [AnzuUser](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Entity/AnzuUser.php)

### Exception

* [AnzuException](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Exception/AnzuException.php)
* [AppReadOnlyModeException](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Exception/AppReadOnlyModeException.php)

### Enums

* [LogLevel](https://github.com/anzusystems/contracts/blob/main/src?path=/src/Model/Enum/LogLevel.php)

More details on how to use Enums in AnzuSystems projects can be found [here](src/Resources/doc/enums.md).
