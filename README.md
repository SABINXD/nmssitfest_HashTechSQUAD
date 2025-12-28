Bal Lok is a safe edutainment(education+entertainment) digital content platform for children aged 3 to 5(pre-school).
It is purely designed with strong parental control features for the new generational way of monitring the children's web consumption.
The platform provides easy access to age-appropriate videos, games, 
rhymes, stories, and educational materials while allowing parents to see and manage what their children access.

        Problem Statement
  In this digital world, children can access online content with ease, 
  which raises serious risks:

  Exposure to inappropriate or harmful videos
  Excessive screen time that is harmful to health and development
  Inadequate real-time parental supervision
  Difficulty in balancing entertainment with educational content.

        Impact: Eye fatigue, behavioral problems, learning lags, and parent anxiety.
   
       Proposed Solution

    Bal Lok addresses these challenges by offering:

  1. Hand-picked Content Gateway: Safe, verified links to child-friendly videos and resources.(youtube for now)
  2. Intelligent Parental Controls: real-time monitoring, category blocking, and limits  on screen time.
  3. Dual-User System: A separate child-friendly portal and parent dashboard.
  4. Educational Incentive - Unlimited educational materials that do not count toward screen time.
  
        Key Features
   For Children (Child Portal)
    Multi-content hub including cartoons: Motu Patlu, Peppa Pig, rhymes, stories, games, and learning materials.
    Friendly for kids: large buttons, clear fonts, and bright colors.
    Persistent screen time banner with friendly alerts.
    Unlimited access to educational content.
    All content opens in tabs, without any ads, comments, or external links.
    
   For Parents (Parent Dashboard)
    Real-time activity monitoring and watch history in detail.
    Daily and weekly activity charts, both broken down by category and video count.
    Controls to block whole categories and establish daily time limits, recommended between (0 to 240 minutes).
    Educational content does not count toward limits.
    Privacy-focused: all tracking data stored locally.

        Security & Authentication
    MySQL and PHP backend with password hashing through bcrypt.
    Role-based access for parents and children.
    The important features related to these activities include session management and secure logout.
    No sensitive data sent outside.
    
        Technology Stack
   Frontend
    HTML5, CSS3 (Flexbox, Grid, Gradients).
    Vanilla JavaScript (ES6+).
    LocalStorage for client-side data.

   Backend
    PHP 7.4 or higher:
    MySQL 8.0
    Apache via XAMPP

        Design
    Comic Sans MS typography
    Playful design with notable icons.
    Fully Responsive for Mobile, Tablet, and Desktop.

        External Services
    YouTube for curated videos.
    Google Sites for game hosting
    Local storage of PDF educational materials.
    System Architecture
    Presentation Layer: Child Portal and Parent Dashboard.
    Business Logic Layer: Authentication and tracking for the time/block checks.

   Data Layer: MySQL for users and sessions; LocalStorage for history, limits, and blocks.
   External Services: YouTube, Google Sites, PDFs.

        Installation
        
   Prerequisites
    XAMPP: Apache and MySQL.
    A modern web browser

   Steps

   1. Install and launch XAMPP (Apache and MySQL).
   2. Open http://localhost/phpmyadmin.
   3. Put all project files in htdocs/bal-lok/.
   4. (Optional) Modify `config.php` if desired.
   5. Access the app at http://localhost/bal-lok/index.html

  Test Login
   E-mail: parent@test.com
   Password: password123

  Usage
  For Parents
    Log in or register at `/login.php`.* Establish daily time limits and block unwanted categories.
    Real-time activity monitoring, history, and weekly summaries.
    
  For Children
    Log in or use a shared device under supervision.
    Browse categories: Shows, Music, Stories, Games, Learn.
    Enjoy safe content with auto time enforcement.
    
  Future Enhancements
  
  Phase 1: Short-term (Prototype)
    More content categories.
    Search and favorites options.
    Multiple child profiles.
    Summary emails.

  Phase 2: Medium-term
    Operating mobile app on Android and iOS.
    AI-driven filtering of content.
    Features include scheduled viewing.
    Achievement badges.

  Phase 3: Long-term
    Multi-language support.
    Offline downloads. 
    Smart TV app. 
    Community for parents
 
  Team Project Title: Bal Lok Team 
  Name: HashTech SQUAD Event: 
  Hackathon Date: 27-28 December 2025 
  Team members 
  - Nirvik Adhikari 
  - Atal Subedi 
  - Hrishav Acharaya 
  - Asnab Raj Pathak 
  
  Acknowledgements 
  - Parents and educators for their valuable feedback Open source community. 
  - YouTube for providing content. 
  - XAMPP team. 
  Organizers of hackathons 
  Created for kids and parents everywhere. 
  Last Updated: December 28, 2025 
  Version: 1.0.0 Status(Active Development)
