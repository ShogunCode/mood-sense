<h1>MoodSense: Mood Logging and Analysis Platform</h1>

MoodSense is a simple, clean, and efficient mood logging platform designed to help users track their moods and gain valuable insights into their mental health. The platform enables users to log their moods using free text and a rating scale of 1-10, and visualizes mood data over time through an intuitive chart. By promoting mindfulness, self-reflection, and self-awareness, MoodSense aids users in understanding their emotional states, identifying triggers, and making conscious choices to improve their well-being.

<h2><b>Table of Contents</b></h2>

- Features
- Technologies
- Implemented Functional and System Requirements
- Implemented Authentication and Security Measures
- API Functionality
- Database Structure
- Underlying Structure


<h2>Features</h2>

- User registration and login with secure authentication
- Simple and intuitive mood logging interface
- Mood summary visualization for different time periods (last 30 days, last 6 months, all-time)
- Scalable Model-View-Controller (MVC) architecture
- Responsive design with Bootstrap framework
- Utilization of AJAX for seamless data fetching and updating
- API Key generation and management

<h2>Technologies</h2>

MoodSense is built using a combination of server-side and client-side technologies, including:

- PHP for server-side processing and API functionality
- MySQL for database management
- HTML and CSS for structure and presentation
- Bootstrap for responsive design and pre-built UI components
- JavaScript for client-side interactivity
- jQuery for DOM manipulation and event handling
- Chart.js for data visualization
- AJAX for asynchronous data fetching
- Implemented Functional and System Requirements
- MoodSense employs the Model-View-Controller (MVC) architecture to effectively manage the project's complexity and facilitate scaling. The MVC pattern abstracts the project into three layers, allowing developers to focus on individual tasks and reducing the likelihood of bugs or breaking existing code.
- The platform also utilizes vector-based SVG images and Bootstrap framework's built-in images to ensure fast loading times and a professional appearance.

<h2>Implemented Authentication and Security Measures</h2>

MoodSense implements several security measures to protect user data and ensure a secure user experience, including:

- API Key generation and management
- Password hashing using PHP's password_hash function
- HTML Special Characters for input validation and sanitization
- Prepared statements for database queries
- Data validation and sanitization on both client-side and server-side
- Session management to prevent session hijacking
- API Functionality

MoodSense API provides the following CRUD operations:

- <b>GET: Retrieve mood logs for a specific user from the database</b>
- <b>POST: Create a new mood log record for a specific user</b>
- <b>PUT: Update an existing mood log record</b>
- <b>DELETE: Delete a mood log record</b>

<h2>Database Structure</h2>

MoodSense utilizes three primary tables in its MySQL database:

users: Contains user information and is updated upon user registration
mood_log: Links to the users table through a relational relationship and stores mood log entries
moodsense_api: Stores API key information for each user, generated upon user registration

<h2>Underlying Structure</h2>

MoodSense relies on PHP for server-side processing, HTML and CSS for structure and styling, JavaScript for client-side interactivity, and various libraries and frameworks such as Bootstrap, jQuery, and Chart.js. The platform employs AJAX for seamless data fetching and updating, improving the overall user experience.
