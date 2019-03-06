@managing_product_scarcity
Feature: Seeing product scarcity
    In order to find out more about product scarcity
    As an Administrator
    I want to see the details of a single product scarcity

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
        And I browse product scarcity list

    Scenario: Seeing product scarcity
        When I see the scarcity of product "Souvenir from Gdansk"
        Then I should see that there are 2 items left at stock
