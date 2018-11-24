Feature: Generating ddd quality php code
  As a developer
  In order to code
  I need to generate a class

  Scenario: Generating an aggregate
    Given I create a file named "Something.wrap" with content:
    """
    aggregate Something
    {
    }
    """
    When I generate the code for file "Something.wrap" in "php" language
    Then The file "Something.php" should have a content of:
    """
    <?php declare(strict_types=1);

    final class Something
    {
        private function __construct()
        {
        }

        public static function fromEmpty(): self
        {
            return new self();
        }
    }

    """

  Scenario: Generating an entity of an aggregate
#    Given I create a file named "Something.wrap" with content:
#    """
#    entity Something
#    {
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    final class Something
#    {
#        private function __construct()
#        {
#        }
#
#        public static function fromEmpty(): self
#        {
#            return new self();
#        }
#    }
#
#    """

  Scenario: Generating a value object
#    Given I create a file named "Something.wrap" with content:
#    """
#    object Something
#    {
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    final class Something
#    {
#        private function __construct()
#        {
#        }
#
#        public static function fromEmpty(): self
#        {
#            return new self();
#        }
#    }
#
#    """

## todo add default construct name ex default construct SomeName
## todo class in sub context of bound context

  Scenario: Generating an aggregate within a bound context
#    Given I create a file named "Something.wrap" with content:
#    """
#
#    context Some\Namespace;
#
#    aggregate Something
#    {
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    namespace Some\Namespace;
#
#    final class
#    {
#    }
#
#    """

  Scenario: Generating an aggregate with an empty construct
#    Given I create a file named "Something.wrap" with content:
#    """
#    aggregate Something
#    {
#        construct withEmpty()
#        {
#        }
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    final class
#    {
#        private function __construct()
#        {
#        }
#
#        public static function withEmpty(): self
#        {
#            return new self();
#        }
#    }
#    """

  Scenario: Generating an aggregate with a method argument
#    Given I create a file named "Something.wrap" with content:
#    """
#    aggregate SomeClass
#    {
#        construct withName(string name)
#        {
#            this.name = name;
#        }
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    use Star\WrapIt\Values\MutableString;
#
#    final class SomeClass
#    {
#        /**
#         * @var MutableString
#         */
#        private $name;
#
#        private function __construct(MutableString $name)
#        {
#            $this->name = $name;
#        }
#
#        public static function withName(string $name): self
#        {
#            return new self(MutableString::fromString($name);
#        }
#    }
#    """

  Scenario: Generating an aggregate with a getter
#    Given I create a file named "Something.wrap" with content:
#    """
#    aggregate SomeClass
#    {
#        property name: { get }
#
#        construct withName(string name)
#        {
#            this.name = name;
#        }
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    use Star\WrapIt\Values\MutableString;
#
#    final class SomeClass
#    {
#        /**
#         * @var MutableString
#         */
#        private $name;
#
#        private function __construct(MutableString $name)
#        {
#            $this->name = $name;
#        }
#
#        public static function withName(string $name): self
#        {
#            return new self(MutableString::fromString($name);
#        }
#
#        public function getName(): string
#        {
#            return $this->name->toString();
#        }
#    }
#    """

  Scenario: Generating an aggregate with a setter
#    Given I create a file named "Something.wrap" with content:
#    """
#    aggregate SomeClass
#    {
#        property name: { set(string) }
#    }
#    """
#    When I generate the code for file "Something.wrap" in "php" language
#    Then The file "Something.php" should have a content of:
#    """
#    <?php declare(strict_types=1);
#
#    use Star\WrapIt\Values\MutableString;
#
#    final class SomeClass
#    {
#        /**
#         * @var MutableString
#         */
#        private $name;
#
#        private function __construct()
#        {
#        }
#
#        public static function withEmpty(): self
#        {
#            return new self();
#        }
#
#        public function setName(string $name): string
#        {
#            $this->name = MutableString::fromString($name);
#        }
#    }
#    """
