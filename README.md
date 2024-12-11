# PHPBasicEventHandler

prototype version

## Installation
Put "events.php" file from "src" folder inside your project.

## How to use
Add line "use EventHandler {}" inside your class. After that, the following methods will be available to you:

- **addListener**(object &$object, string $methodName): bool - Add method to subscribers list.
- **removeListener**(&$object, string $methodName): bool - Remove method from subscribers.
- **removeAllListeners**(): bool - Wipe list.
- **invoke**($value): bool - Invoke all subscribers.

There is a simple example in the project inside "example" folder.
