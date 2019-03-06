@managing_product_scarcity
Feature: Being able to see which products are scarce
    In order to arrange products' delivery properly
    As an Administrator
    I want to be able to see which products are scarce

    Background:
        Given the store operates on a single channel in "United States"
        And the store has a product "Souvenir from Gdansk"
        And the "Souvenir from Gdansk" product is tracked by the inventory
        And there are 5 units of product "Souvenir from Gdansk" available in the inventory
        And the store has "DHL" shipping method with "$10.00" fee
        And the store allows paying with "Cash on Delivery"
        And there is a customer "workshop.participant@sylius.com" that placed an order "#00000001"
        And the customer bought 3 "Souvenir from Gdansk" products
        And the customer chose "DHL" shipping method to "United States" with "Cash on Delivery" payment
        And I am logged in as an administrator

    Scenario: Being able to see which products are scarce
        When I browse product scarcity list
        Then I should see that "Souvenir from Gdansk" product is scarce
