## Tasks

**Prep:**

* [x] Strategy
* [X] Data modeling

**Backend:**

* [ ] Bootstrapping
* [x] Entities
  * [x] Fields
  * [x] Subscribers
  * [x] Entity relationship problem
* [ ] Repositories
  * [ ] Field repository
  * [ ] Subscriber repository
* [ ] Use Cases - Fields
  * [ ] Create field
  * [ ] Read field
  * [ ] Update field
  * [ ] Delete field
* [ ] Use Cases - Subscribers
  * [ ] Create subscriber
  * [ ] Read subscriber
  * [ ] Update subscriber
  * [ ] Delete subscriber
* [ ] Use Cases - management
  * [ ] Subscriber adds field
  * [ ] Subscriber removes field
  
**Frontend:**

* [ ] Manage fields
  * [ ] Create field
  * [ ] Read field
  * [ ] Update field
  * [ ] Delete field
* [ ] Manage subscribers
  * [ ] Create field
  * [ ] Read field
  * [ ] Update field
  * [ ] Delete field

**Optionals:**

* [ ] Unit Tests
* [ ] Add Redis to repositories
* [ ] Dockerize the test app

## Data model

Subscriber
- id
- email
- name
- state

Field
- id
- subscriber id
- title
- type
- value

## Strategy

1. Needed packages:
   * dotenv for config
   * fractal for json API response
   * skip router for simplicity
   * doctrine/dbal for non orm-based DB layer
  
2. index.php file to bootstrap packages

3. use clean architecture to implement all below http layer

4. Caching:
   * write through cache for inserts/updates, with cache TTL  
   * lazy loading for reads 

