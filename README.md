# **OLX Price Tracker**

## **Project Description**

This service allows users to track price changes for OLX listings. Users can subscribe by providing a link to the listing and their email address. The service periodically checks the listing for price updates and sends notifications via email if the price changes.

---

## **Features**

- **Subscription for Price Tracking**: Users can subscribe to track price changes by providing a listing URL and email.
- **Price Monitoring**: The service periodically checks subscribed listings for price updates.
- **Email Notifications**: If a price change is detected, the user receives an email notification with the updated price.
- **Efficient Monitoring**: Multiple users can subscribe to the same listing without redundant checks.
- **Email Confirmation**: Users must confirm their email addresses to activate the subscription.
- **Docker Integration**: The project runs in Docker containers for easy deployment.
- **Unit Tests**: Includes test coverage of more than 70%.

---

## **System Workflow**

1. **User Subscription**:
    - The user sends an HTTP request with the listing URL and email address.
    - The server saves the subscription in the database and sends a confirmation email.
2. **Price Monitoring**:
    - A Laravel CRON job (scheduler) checks the subscribed listings periodically.
    - The service fetches the current price of the listing via web scraping.
    - If the price has changed, the service updates the database.
3. **Notification**:
    - An email is sent to all users subscribed to the listing, notifying them of the price change.

---

## **Setup Instructions**

### **Prerequisites**

- **PHP 8.2**
- **Composer**
- **Docker** (with Docker Compose)
- **Node.js** (optional, for front-end assets)

### **Installation Steps**

1. Clone the repository:

   ```bash
   git clone https://github.com/<your-username>/olx-price-tracker.git
   cd olx-price-tracker
   
2. Copy .env.example to .env and configure:

   ```bash
   cp .env.example .env
   
3. Update the following variables in .env:
   
   ```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=ads_tracker
    DB_USERNAME=root
    DB_PASSWORD=root
    
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=<your-mailtrap-username>
    MAIL_PASSWORD=<your-mailtrap-password>
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=your-email@example.com
    MAIL_FROM_NAME="OLX Price Tracker"
   
4. Build and start the Docker containers:

   ```
    docker-compose up --build

5. Access the application:

   ```
   Open http://localhost:8000 in your browser.
