-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2026 at 06:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aiiiis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisory_requests`
--

CREATE TABLE `advisory_requests` (
  `advisory_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `expert_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `status` enum('pending','assigned','in_progress','resolved','closed') DEFAULT 'pending',
  `assigned_at` datetime DEFAULT NULL,
  `resolved_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_knowledge`
--

CREATE TABLE `chatbot_knowledge` (
  `knowledge_id` int(11) UNSIGNED NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `keywords` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `confidence_score` decimal(5,2) DEFAULT 0.00,
  `usage_count` int(11) DEFAULT 0,
  `is_approved` tinyint(1) DEFAULT 1,
  `created_by` enum('system','support','user') DEFAULT 'system',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_knowledge`
--

INSERT INTO `chatbot_knowledge` (`knowledge_id`, `service_id`, `question`, `answer`, `keywords`, `category`, `confidence_score`, `usage_count`, `is_approved`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'operations-followup', 'What is operations follow-up?', 'Operations Follow-up is a service that provides dedicated operational monitoring and support to ensure your industrial processes run smoothly and efficiently.', 'operations, follow-up, monitoring, support, industrial, processes', NULL, 0.00, 4, 1, 'system', NULL, '2026-08-12 15:26:56'),
(2, 'operations-followup', 'How can I get operations support?', 'You can get operations support by contacting our team through this chat, sending an email, or reaching out via WhatsApp. Our team is available 24/7.', 'operations, support, contact, help, assistance', NULL, 0.00, 1, 1, 'system', NULL, '2026-08-11 13:36:26'),
(3, 'business-advisor', 'What is business advisor service?', 'The Business Advisor service provides expert business advisory services to help you make informed decisions and grow your enterprise strategically.', 'business, advisor, advisory, strategic, growth, decisions', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(4, 'technical-support', 'What is technical support?', 'Technical Support provides specialized technical support for your industrial machinery, systems, and technology infrastructure.', 'technical, support, machinery, systems, technology, infrastructure', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(5, 'rd-services', 'What is R&D and Life Lab services?', 'R&D and Life Lab Services provide access to state-of-the-art R&D facilities and Life Lab services to drive innovation and product development.', 'research, development, life lab, innovation, product development', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(6, 'stem-services', 'What are STEM services?', 'STEM Services provide access to specialized STEM programs and resources to build technical capabilities and foster innovation.', 'STEM, science, technology, engineering, mathematics, training, skills', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(7, 'investor-matchmaking', 'What is investor matchmaking?', 'Investor Matchmaking connects enterprises with the right investors using AI-powered matchmaking platform.', 'investor, matchmaking, funding, investment, AI, matching', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(8, 'operations-followup', 'What is operations follow-up?', 'Operations Follow-up is a service that provides dedicated operational monitoring and support to ensure your industrial processes run smoothly and efficiently.', 'operations, follow-up, monitoring, support, industrial, processes', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(9, 'operations-followup', 'How can I get operations support?', 'You can get operations support by contacting our team through this chat, sending an email, or reaching out via WhatsApp. Our team is available 24/7.', 'operations, support, contact, help, assistance', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(10, 'business-advisor', 'What is business advisor service?', 'The Business Advisor service provides expert business advisory services to help you make informed decisions and grow your enterprise strategically.', 'business, advisor, advisory, strategic, growth, decisions', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(11, 'business-advisor', 'How can a business advisor help me?', 'A business advisor can help with strategic planning, market analysis, financial planning, and business model optimization to help your enterprise grow.', 'business, advisor, help, strategic, planning, growth', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(12, 'technical-support', 'What is technical support?', 'Technical Support provides specialized technical support for your industrial machinery, systems, and technology infrastructure.', 'technical, support, machinery, systems, technology, infrastructure', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(13, 'technical-support', 'How do I get technical support?', 'You can request technical support through this chat, email, or WhatsApp. Our technical team will assist you with troubleshooting and maintenance.', 'technical, support, help, assistance, troubleshooting', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(14, 'rd-services', 'What is R&D and Life Lab services?', 'R&D and Life Lab Services provide access to state-of-the-art R&D facilities and Life Lab services to drive innovation and product development.', 'research, development, life lab, innovation, product development', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(15, 'rd-services', 'What facilities are available in the Life Lab?', 'The Life Lab provides access to laboratory facilities, product development support, testing and certification services, and research partnership opportunities.', 'life lab, facilities, laboratory, testing, research', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(16, 'stem-services', 'What are STEM services?', 'STEM Services provide access to specialized STEM programs and resources to build technical capabilities and foster innovation.', 'STEM, science, technology, engineering, mathematics, training, skills', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(17, 'stem-services', 'What STEM programs are available?', 'We offer STEM training programs, workshops and seminars, technical skill development, and industry-academia collaboration opportunities.', 'STEM, programs, training, workshops, skills, collaboration', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(18, 'investor-matchmaking', 'What is investor matchmaking?', 'Investor Matchmaking connects enterprises with the right investors using AI-powered matchmaking platform.', 'investor, matchmaking, funding, investment, AI, matching', NULL, 0.00, 0, 1, 'system', NULL, NULL),
(19, 'investor-matchmaking', 'How does investor matchmaking work?', 'Our AI-powered matchmaking engine connects enterprises with investors based on sector, growth potential, and investment readiness.', 'investor, matchmaking, AI, matching, funding, investment', NULL, 0.00, 0, 1, 'system', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_unanswered`
--

CREATE TABLE `chatbot_unanswered` (
  `unanswered_id` int(11) UNSIGNED NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `service_id` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `status` enum('pending','reviewed','answered') DEFAULT 'pending',
  `support_reply` text DEFAULT NULL,
  `support_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `message_id` int(11) UNSIGNED NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `service_id` varchar(50) NOT NULL,
  `sender_type` enum('user','support') NOT NULL DEFAULT 'user',
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`message_id`, `session_id`, `user_id`, `service_id`, `sender_type`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, '', 1, 'operations-followup', 'user', 'i want help', 1, '2026-08-11 13:36:26', '2026-08-11 17:11:50'),
(2, '', NULL, 'operations-followup', 'support', 'You can get operations support by contacting our team through this chat, sending an email, or reaching out via WhatsApp. Our team is available 24/7.', 1, '2026-08-11 13:36:26', '2026-08-11 13:36:26'),
(3, '', 1, 'operations-followup', 'user', 'hy', 1, '2026-08-11 13:36:48', '2026-08-11 17:11:50'),
(4, '', NULL, 'operations-followup', 'user', 'hy', 1, '2026-08-11 15:33:18', '2026-08-11 17:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `deal_id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `deal_amount` decimal(15,2) DEFAULT 0.00,
  `deal_type` varchar(50) DEFAULT NULL,
  `status` enum('negotiating','agreed','signed','completed','cancelled') DEFAULT 'negotiating',
  `expected_close_date` date DEFAULT NULL,
  `actual_close_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `match_id`, `enterprise_id`, `investor_id`, `deal_amount`, `deal_type`, `status`, `expected_close_date`, `actual_close_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2000000.00, 'Equity Investment', 'completed', '2026-03-15', NULL, 'Deal closed successfully. Investment for new machinery.', '2026-08-05 09:27:24', '2026-08-05 09:27:24'),
(2, 4, 2, 4, 1500000.00, 'Equity Investment', 'signed', '2026-03-01', NULL, 'Agreement signed for cold storage facility.', '2026-08-05 09:27:24', '2026-08-05 09:27:24'),
(3, 7, 3, 1, 1000000.00, 'Venture Capital', 'signed', '2026-03-20', NULL, 'VC funding for AI product development.', '2026-08-05 09:27:24', '2026-08-05 11:05:14'),
(4, 10, 4, 1, 3000000.00, 'Project Finance', 'agreed', '2026-04-01', NULL, 'Solar farm expansion agreed in principle.', '2026-08-05 09:27:24', '2026-08-05 11:05:14'),
(5, 9, 1, 1, 500000.00, 'Debt Financing', 'completed', '2026-01-30', NULL, 'Short-term loan for working capital.', '2026-08-05 09:27:24', '2026-08-05 09:27:24'),
(6, 5, 2, 5, 1200000.00, 'Equity Investment', 'negotiating', '2026-04-30', NULL, 'Negotiating terms with government fund.', '2026-08-05 09:27:24', '2026-08-05 09:27:24'),
(11, 1, 1, 1, 2000000.00, 'Equity Investment', 'completed', '2026-03-15', NULL, 'Deal closed successfully. Investment for new machinery.', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(12, 4, 2, 4, 1500000.00, 'Equity Investment', 'signed', '2026-03-01', NULL, 'Agreement signed for cold storage facility.', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(13, 7, 3, 1, 1000000.00, 'Venture Capital', 'signed', '2026-03-20', NULL, 'VC funding for AI product development.', '2026-08-05 09:30:28', '2026-08-05 11:05:14'),
(14, 10, 4, 1, 3000000.00, 'Project Finance', 'agreed', '2026-04-01', NULL, 'Solar farm expansion agreed in principle.', '2026-08-05 09:30:28', '2026-08-05 11:05:14'),
(15, 9, 1, 1, 500000.00, 'Debt Financing', 'completed', '2026-01-30', NULL, 'Short-term loan for working capital.', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(16, 5, 2, 5, 1200000.00, 'Equity Investment', 'negotiating', '2026-04-30', NULL, 'Negotiating terms with government fund.', '2026-08-05 09:30:28', '2026-08-05 09:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `engagements`
--

CREATE TABLE `engagements` (
  `engagement_id` int(11) NOT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `expert_id` int(11) DEFAULT NULL,
  `type` enum('visit','meeting','advisory','training','support','follow_up') DEFAULT 'meeting',
  `date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `outcome` text DEFAULT NULL,
  `next_follow_up` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `engagements`
--

INSERT INTO `engagements` (`engagement_id`, `enterprise_id`, `expert_id`, `type`, `date`, `location`, `description`, `outcome`, `next_follow_up`, `created_at`, `updated_at`) VALUES
(13, 1, 1, 'visit', '2026-01-10 10:00:00', 'Kigali', 'Factory visit to assess manufacturing processes', 'Identified areas for improvement and efficiency gains', '2026-02-10', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(14, 2, 3, 'advisory', '2026-01-15 14:30:00', 'Musanze', 'Advisory session on agricultural processing methods', 'Recommended new processing techniques', '2026-02-15', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(15, 3, 2, 'meeting', '2026-01-20 09:00:00', 'Kigali', 'Meeting to discuss technology adoption strategy', 'Developed technology roadmap', '2026-02-20', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(16, 4, 2, 'training', '2026-01-22 13:00:00', 'Rubavu', 'Training on renewable energy systems', 'Staff trained on solar panel installation', '2026-02-22', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(17, 1, 2, 'follow_up', '2026-01-30 16:00:00', 'Kigali', 'Follow-up on previous recommendations', 'Implementation progress review', '2026-02-28', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(18, 3, 1, 'training', '2026-02-03 11:00:00', 'Kigali', 'Training on quality management systems', 'Quality standards improved', '2026-03-03', '2026-08-05 09:30:28', '2026-08-05 09:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

CREATE TABLE `enterprises` (
  `enterprise_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `enterprise_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `registration_number` varchar(100) DEFAULT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `sub_sector` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `products_services` text DEFAULT NULL,
  `employees` int(11) DEFAULT 0,
  `revenue` decimal(15,2) DEFAULT 0.00,
  `growth_potential` decimal(5,2) DEFAULT 0.00,
  `technology_level` varchar(50) DEFAULT NULL,
  `innovation_capacity` decimal(5,2) DEFAULT 0.00,
  `environmental_sustainability` decimal(5,2) DEFAULT 0.00,
  `social_inclusion` decimal(5,2) DEFAULT 0.00,
  `investment_requirements` text DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive','pending') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_women_owned` tinyint(1) DEFAULT 0,
  `rdb_certificate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprises`
--

INSERT INTO `enterprises` (`enterprise_id`, `user_id`, `enterprise_name`, `name`, `registration_number`, `sector`, `sub_sector`, `location`, `latitude`, `longitude`, `contact_person`, `email`, `phone`, `website`, `products_services`, `employees`, `revenue`, `growth_potential`, `technology_level`, `innovation_capacity`, `environmental_sustainability`, `social_inclusion`, `investment_requirements`, `is_verified`, `status`, `created_at`, `updated_at`, `is_women_owned`, `rdb_certificate`) VALUES
(1, 3, '', 'Kigali Manufacturing Ltd', 'REG-001', 'Manufacturing', 'Textile', 'Kigali', NULL, NULL, 'John Doe', 'info@kigalimanufacturing.rw', '+250 788 123 001', NULL, NULL, 150, 5000000.00, 0.00, NULL, 0.00, 0.00, 0.00, NULL, 1, 'active', '2026-08-04 19:56:11', '2026-08-04 19:56:11', 0, NULL),
(2, 3, '', 'Rwanda Agri-Processors', 'REG-002', 'Agribusiness', 'Food Processing', 'Musanze', NULL, NULL, 'Jane Smith', 'info@rwandaagri.rw', '+250 788 123 002', NULL, NULL, 80, 2000000.00, 0.00, NULL, 0.00, 0.00, 0.00, NULL, 1, 'active', '2026-08-04 19:56:11', '2026-08-06 10:17:50', 1, NULL),
(3, 3, '', 'Tech Hub Rwanda', 'REG-003', 'Technology', 'Software', 'Kigali', NULL, NULL, 'Peter Kim', 'info@techhub.rw', '+250 788 123 003', NULL, NULL, 45, 1500000.00, 0.00, NULL, 0.00, 0.00, 0.00, NULL, 0, 'pending', '2026-08-04 19:56:11', '2026-08-04 19:56:11', 0, NULL),
(4, 3, '', 'Green Energy Solutions', 'REG-004', 'Energy', 'Renewable', 'Rubavu', NULL, NULL, 'Maria Santos', 'info@greenenergy.rw', '+250 788 123 004', NULL, NULL, 60, 3000000.00, 0.00, NULL, 0.00, 0.00, 0.00, NULL, 1, 'active', '2026-08-04 19:56:11', '2026-08-06 10:17:50', 1, NULL),
(15, 58, '', 'Rwanda Textile Mills', 'REG-005', 'Manufacturing', 'Textile', 'Kigali', -1.95000000, 30.07000000, 'Ahmed Hassan', 'info@rwandatextile.rw', '+250 788 123 005', 'www.rwandatextile.rw', 'Cotton processing, textile manufacturing, exports', 200, 8000000.00, 88.00, 'Advanced', 75.00, 78.00, 82.00, 'Seeking $5M for new production line', 1, 'active', '2026-08-05 09:25:04', '2026-08-05 09:25:04', 0, NULL),
(16, 59, '', 'AgriTech Solutions', 'REG-006', 'Agribusiness', 'Technology', 'Kigali', -1.94000000, 30.06000000, 'Charles Mugisha', 'info@agritech.rw', '+250 788 123 006', 'www.agritech.rw', 'Agricultural technology, smart farming, IoT solutions', 35, 800000.00, 95.00, 'Cutting-edge', 98.00, 85.00, 90.00, 'Looking for $800K for product scaling', 1, 'active', '2026-08-05 09:25:04', '2026-08-05 09:25:04', 0, NULL),
(17, 60, '', 'Rwanda Construction Ltd', 'REG-007', 'Construction', 'Infrastructure', 'Kigali', -1.93000000, 30.08000000, 'David Uwimana', 'info@rwandaconstruction.rw', '+250 788 123 007', 'www.rwandaconstruction.rw', 'Construction, infrastructure, building materials', 120, 4000000.00, 65.00, 'Intermediate', 60.00, 72.00, 78.00, 'Seeking $2.5M for equipment purchase', 1, 'active', '2026-08-05 09:25:04', '2026-08-05 09:25:04', 0, NULL),
(18, 61, '', 'Kivu Energy Solutions', 'REG-008', 'Energy', 'Renewable', 'Rubavu', -1.68000000, 29.22000000, 'Jean Claude', 'info@kivuenergy.rw', '+250 788 123 008', 'www.kivuenergy.rw', 'Hydro power, renewable energy projects', 45, 2000000.00, 82.00, 'Advanced', 80.00, 95.00, 65.00, 'Looking for $2M for mini-hydro project', 1, 'active', '2026-08-05 09:25:04', '2026-08-05 09:25:04', 0, NULL),
(19, 62, '', 'Rwanda Fintech Ltd', 'REG-009', 'Financial Services', 'Fintech', 'Kigali', -1.94500000, 30.06500000, 'Sarah Mbabazi', 'info@rwandafintech.rw', '+250 788 123 009', 'www.rwandafintech.rw', 'Mobile payments, financial inclusion, banking solutions', 50, 2500000.00, 90.00, 'Cutting-edge', 92.00, 68.00, 95.00, 'Seeking $1.5M for platform expansion', 1, 'active', '2026-08-05 09:25:04', '2026-08-05 09:25:04', 0, NULL),
(20, 63, '', 'Mountain Tourism Rwanda', 'REG-010', 'Tourism', 'Hospitality', 'Musanze', -1.48000000, 29.64000000, 'Olivier Ngabo', 'info@mountaintourism.rw', '+250 788 123 010', 'www.mountaintourism.rw', 'Eco-tourism, mountain gorilla tours, hospitality', 75, 1800000.00, 70.00, 'Intermediate', 65.00, 88.00, 72.00, 'Looking for $1.2M for lodge expansion', 1, 'active', '2026-08-05 09:25:04', '2026-08-05 09:25:04', 0, NULL),
(45, NULL, '', 'nina umukundwa', 'reg - 005', 'Agribusiness', 'software', 'nyanza', 0.00000000, 0.00000000, 'nina umukundwa', 'ninaumukundwa@gmail.com', '+250725096670', '', ' food', 2, 126.00, 0.00, NULL, 0.00, 0.00, 0.00, '100000', 1, 'active', '2026-08-06 05:39:27', '2026-08-06 05:39:27', 0, NULL),
(46, 73, 'nina umukundwa', 'nina umukundwa', NULL, 'education', NULL, 'nyanza', NULL, NULL, '0725096678', 'ninaumukundwa@gmail.com', '0725096678', NULL, 'wertyuiop', 1, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 'wertyuil', 0, 'pending', '2026-08-10 08:19:34', '2026-08-10 08:19:34', 0, '1786360774_86450ce94a7d7592e15b.pdf'),
(47, 74, 'niventra zyveron', 'niventra zyveron', NULL, 'technology', NULL, 'nyanza', NULL, NULL, '0725096678', 'ninababery@gmail.com', '0725096678', NULL, 'dhadblfj,adhfuirty3iurjkwkdlsxncsdjfuyweufhwedisjanshdryuweiaxjanwuieuheryueruiwhjgefyutrquoaerwfgyq3ruoegyefytuoetyweuiukfhwuieryytrihwdjkwedwieury3yto8', 1, 100000.00, 0.00, NULL, 0.00, 0.00, 0.00, 'kzjcszshraeruitncnjdkfheriutuiwetuoeirtuoerutweiortueroitueiorutoeirutoeirtueotueouteoueorueotureouowtwoiweriwetoweruowetiotouotuowtuotuowetuoetuoietuioruioweroi', 0, 'pending', '2026-08-11 04:52:09', '2026-08-11 04:52:09', 0, '1786434729_65a3cc9edf39243afac9.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_rankings`
--

CREATE TABLE `enterprise_rankings` (
  `ranking_id` int(11) NOT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `growth_score` decimal(5,2) DEFAULT 0.00,
  `innovation_score` decimal(5,2) DEFAULT 0.00,
  `technology_score` decimal(5,2) DEFAULT 0.00,
  `sustainability_score` decimal(5,2) DEFAULT 0.00,
  `social_inclusion_score` decimal(5,2) DEFAULT 0.00,
  `investment_potential_score` decimal(5,2) DEFAULT 0.00,
  `total_score` decimal(5,2) DEFAULT 0.00,
  `rank_position` int(11) DEFAULT 0,
  `ranking_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_rankings`
--

INSERT INTO `enterprise_rankings` (`ranking_id`, `enterprise_id`, `growth_score`, `innovation_score`, `technology_score`, `sustainability_score`, `social_inclusion_score`, `investment_potential_score`, `total_score`, `rank_position`, `ranking_date`, `created_at`, `updated_at`) VALUES
(1, 1, 85.00, 78.00, 82.00, 75.00, 80.00, 82.00, 80.33, 1, '2026-08-04', '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(2, 2, 72.00, 68.00, 70.00, 85.00, 75.00, 74.00, 74.00, 2, '2026-08-04', '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(3, 4, 78.00, 82.00, 75.00, 80.00, 70.00, 77.00, 77.00, 3, '2026-08-04', '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(4, 1, 85.00, 78.00, 82.00, 75.00, 80.00, 82.00, 80.33, 3, '2026-08-05', '2026-08-05 09:26:27', '2026-08-05 09:26:27'),
(5, 2, 72.00, 68.00, 70.00, 85.00, 75.00, 74.00, 74.00, 7, '2026-08-05', '2026-08-05 09:26:27', '2026-08-05 09:26:27'),
(6, 3, 92.00, 95.00, 98.00, 70.00, 85.00, 90.00, 88.33, 1, '2026-08-05', '2026-08-05 09:26:27', '2026-08-05 09:26:27'),
(7, 4, 78.00, 82.00, 75.00, 90.00, 70.00, 77.00, 78.67, 5, '2026-08-05', '2026-08-05 09:26:27', '2026-08-05 09:26:27'),
(14, 1, 85.00, 78.00, 82.00, 75.00, 80.00, 82.00, 80.33, 3, '2026-08-05', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(15, 2, 72.00, 68.00, 70.00, 85.00, 75.00, 74.00, 74.00, 7, '2026-08-05', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(16, 3, 92.00, 95.00, 98.00, 70.00, 85.00, 90.00, 88.33, 1, '2026-08-05', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(17, 4, 78.00, 82.00, 75.00, 90.00, 70.00, 77.00, 78.67, 5, '2026-08-05', '2026-08-05 09:30:28', '2026-08-05 09:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE `experts` (
  `expert_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `expertise` text DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `availability` enum('available','busy','unavailable') DEFAULT 'available',
  `experience_years` int(11) DEFAULT 0,
  `biography` text DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experts`
--

INSERT INTO `experts` (`expert_id`, `user_id`, `name`, `expertise`, `specialization`, `location`, `availability`, `experience_years`, `biography`, `department`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dr. Alice Mbabazi', 'Industrial development, Innovation strategy', 'Manufacturing', 'Kigali', 'available', 15, NULL, 'Industrial Development', '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(2, 2, 'Eng. James Kagame', 'Technology transfer, Energy systems', 'Energy', 'Kigali', 'available', 12, NULL, 'Technology Innovation', '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(3, 2, 'Dr. Grace Uwimana', 'Agricultural processing, Value addition', 'Agribusiness', 'Musanze', 'busy', 10, NULL, 'Agribusiness', '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(4, 50, 'Dr. Alice Mbabazi', 'Industrial development, Innovation strategy, Manufacturing excellence', 'Manufacturing', 'Kigali', 'available', 15, 'PhD in Industrial Engineering with 15 years experience in manufacturing and industrial development.', 'Industrial Development', '2026-08-05 09:26:08', '2026-08-05 09:26:08'),
(5, 51, 'Eng. James Kagame', 'Technology transfer, Energy systems, Renewable energy', 'Energy', 'Kigali', 'available', 12, 'MSc in Energy Systems with expertise in renewable energy and technology transfer.', 'Technology Innovation', '2026-08-05 09:26:08', '2026-08-05 09:26:08'),
(6, 52, 'Dr. Grace Uwimana', 'Agricultural processing, Value addition, Food safety', 'Agribusiness', 'Musanze', 'busy', 10, 'PhD in Food Science with specialization in agricultural processing and value addition.', 'Agribusiness', '2026-08-05 09:26:08', '2026-08-05 09:26:08'),
(7, 53, 'Eng. Patrick Ndayisaba', 'Construction management, Infrastructure development', 'Construction', 'Kigali', 'available', 8, 'MSc in Civil Engineering with focus on sustainable construction.', 'Infrastructure', '2026-08-05 09:26:08', '2026-08-05 09:26:08'),
(8, 50, 'Dr. Alice Mbabazi', 'Industrial development, Innovation strategy, Manufacturing excellence', 'Manufacturing', 'Kigali', 'available', 15, 'PhD in Industrial Engineering with 15 years experience in manufacturing and industrial development.', 'Industrial Development', '2026-08-05 09:30:27', '2026-08-05 09:30:27'),
(9, 51, 'Eng. James Kagame', 'Technology transfer, Energy systems, Renewable energy', 'Energy', 'Kigali', 'available', 12, 'MSc in Energy Systems with expertise in renewable energy and technology transfer.', 'Technology Innovation', '2026-08-05 09:30:27', '2026-08-05 09:30:27'),
(10, 52, 'Dr. Grace Uwimana', 'Agricultural processing, Value addition, Food safety', 'Agribusiness', 'Musanze', 'busy', 10, 'PhD in Food Science with specialization in agricultural processing and value addition.', 'Agribusiness', '2026-08-05 09:30:27', '2026-08-05 09:30:27'),
(11, 53, 'Eng. Patrick Ndayisaba', 'Construction management, Infrastructure development', 'Construction', 'Kigali', 'available', 8, 'MSc in Civil Engineering with focus on sustainable construction.', 'Infrastructure', '2026-08-05 09:30:27', '2026-08-05 09:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk_requests`
--

CREATE TABLE `helpdesk_requests` (
  `ticket_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `status` enum('open','in_progress','resolved','closed') DEFAULT 'open',
  `assigned_to` int(11) DEFAULT NULL,
  `resolved_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk_responses`
--

CREATE TABLE `helpdesk_responses` (
  `response_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_internal` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investment_requests`
--

CREATE TABLE `investment_requests` (
  `request_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `funding_required` decimal(15,2) DEFAULT 0.00,
  `funding_type` varchar(50) DEFAULT NULL,
  `use_of_funds` text DEFAULT NULL,
  `timeline` varchar(100) DEFAULT NULL,
  `business_plan` varchar(255) DEFAULT NULL,
  `financial_model` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `investor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `id_document` varchar(255) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `type` enum('individual','institutional','venture_capital','angel','government') DEFAULT 'individual',
  `investment_sector` text DEFAULT NULL,
  `preferred_enterprise_type` varchar(100) DEFAULT NULL,
  `investment_amount_min` decimal(15,2) DEFAULT 0.00,
  `investment_amount_max` decimal(15,2) DEFAULT 0.00,
  `geographic_preferences` text DEFAULT NULL,
  `technology_interests` text DEFAULT NULL,
  `sustainability_preferences` text DEFAULT NULL,
  `investment_stage` enum('seed','early','growth','expansion','mature') DEFAULT 'growth',
  `expected_returns` decimal(5,2) DEFAULT 0.00,
  `investment_criteria` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`investor_id`, `user_id`, `full_name`, `email`, `country`, `id_document`, `name`, `type`, `investment_sector`, `preferred_enterprise_type`, `investment_amount_min`, `investment_amount_max`, `geographic_preferences`, `technology_interests`, `sustainability_preferences`, `investment_stage`, `expected_returns`, `investment_criteria`, `status`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 4, '', '', '', NULL, 'East Africa Capital Partners', 'institutional', 'Manufacturing,Technology,Agribusiness', NULL, 1000000.00, 10000000.00, 'Kigali,Musanze', NULL, NULL, 'growth', 0.00, NULL, 'pending', 0, '2026-08-04 19:56:12', '2026-08-04 19:56:12'),
(4, 64, '', '', '', NULL, 'East Africa Capital Partners', 'institutional', 'Manufacturing,Technology,Agribusiness', 'Growth-stage enterprises', 1000000.00, 10000000.00, 'Kigali,Musanze,Rubavu', 'AI, IoT, Clean Technology', 'High sustainability focus', 'growth', 20.50, 'Looking for scalable businesses with strong management teams', 'pending', 1, '2026-08-05 09:25:48', '2026-08-05 09:25:48'),
(5, 65, '', '', '', NULL, 'Rwanda Investment Fund', 'government', 'Energy,Infrastructure,Technology', 'All stages', 500000.00, 5000000.00, 'National', 'Renewable energy, Infrastructure', 'Sustainability required', 'expansion', 15.00, 'Government-backed fund for strategic sectors', 'pending', 1, '2026-08-05 09:25:48', '2026-08-05 09:25:48'),
(6, 66, '', '', '', NULL, 'GreenTech Ventures', 'venture_capital', 'Technology,Renewable Energy', 'Early-stage startups', 200000.00, 2000000.00, 'Kigali', 'Clean tech, Green energy, Climate tech', 'Strong sustainability preference', 'early', 25.00, 'Focus on innovative green technology solutions', 'pending', 1, '2026-08-05 09:25:48', '2026-08-05 09:25:48'),
(7, 67, '', '', '', NULL, 'African Innovation Fund', 'venture_capital', 'Technology,Agribusiness,Financial Services', 'Early to growth stage', 500000.00, 3000000.00, 'Regional', 'AI, Blockchain, AgriTech', 'Moderate sustainability', 'early', 22.00, 'Supporting African innovation and entrepreneurship', 'pending', 1, '2026-08-05 09:25:48', '2026-08-05 09:25:48'),
(8, 65, '', '', '', NULL, 'Rwanda Development Bank', 'government', 'Manufacturing,Construction,Energy', 'All stages', 1000000.00, 15000000.00, 'National', 'Industrial development', 'Sustainability required', 'growth', 12.00, 'Development-focused investment for industrial growth', 'pending', 1, '2026-08-05 09:25:48', '2026-08-05 09:25:48'),
(9, 64, '', '', '', NULL, 'East Africa Capital Partners', 'institutional', 'Manufacturing,Technology,Agribusiness', 'Growth-stage enterprises', 1000000.00, 10000000.00, 'Kigali,Musanze,Rubavu', 'AI, IoT, Clean Technology', 'High sustainability focus', 'growth', 20.50, 'Looking for scalable businesses with strong management teams', 'pending', 1, '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(10, 65, '', '', '', NULL, 'Rwanda Investment Fund', 'government', 'Energy,Infrastructure,Technology', 'All stages', 500000.00, 5000000.00, 'National', 'Renewable energy, Infrastructure', 'Sustainability required', 'expansion', 15.00, 'Government-backed fund for strategic sectors', 'pending', 1, '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(11, 66, '', '', '', NULL, 'GreenTech Ventures', 'venture_capital', 'Technology,Renewable Energy', 'Early-stage startups', 200000.00, 2000000.00, 'Kigali', 'Clean tech, Green energy, Climate tech', 'Strong sustainability preference', 'early', 25.00, 'Focus on innovative green technology solutions', 'pending', 1, '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(12, 67, '', '', '', NULL, 'African Innovation Fund', 'venture_capital', 'Technology,Agribusiness,Financial Services', 'Early to growth stage', 500000.00, 3000000.00, 'Regional', 'AI, Blockchain, AgriTech', 'Moderate sustainability', 'early', 22.00, 'Supporting African innovation and entrepreneurship', 'pending', 1, '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(13, 68, '', '', '', NULL, 'Rwanda Development Bank', 'government', 'Manufacturing,Construction,Energy', 'All stages', 1000000.00, 15000000.00, 'National', 'Industrial development', 'Sustainability required', 'growth', 12.00, 'Development-focused investment for industrial growth', 'pending', 1, '2026-08-05 11:05:46', '2026-08-05 11:05:46'),
(14, NULL, '', '', '', NULL, 'babery', 'individual', 'Technology', 'Startup', 20000.00, 100000000000.00, 'kigali', 'AI', 'High sustainability focus', 'growth', 3.40, 'FOCUS', 'pending', 0, '2026-08-06 07:02:36', '2026-08-06 07:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `iot_data`
--

CREATE TABLE `iot_data` (
  `sensor_id` int(11) NOT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `sensor_name` varchar(100) DEFAULT NULL,
  `parameter` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `is_alert` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iot_data`
--

INSERT INTO `iot_data` (`sensor_id`, `enterprise_id`, `sensor_name`, `parameter`, `value`, `unit`, `timestamp`, `is_alert`, `created_at`) VALUES
(1, 1, 'Temperature Sensor 1', 'temperature', '24.5', '°C', '2026-08-05 12:26:36', 0, '2026-08-05 09:31:36'),
(2, 1, 'Energy Monitor', 'power_consumption', '145.2', 'kWh', '2026-08-05 12:21:36', 0, '2026-08-05 09:31:36'),
(3, 1, 'Production Line', 'output_rate', '87', 'units/hour', '2026-08-05 12:16:36', 0, '2026-08-05 09:31:36'),
(4, 2, 'Temperature Sensor 2', 'temperature', '22.1', '°C', '2026-08-05 12:23:36', 0, '2026-08-05 09:31:36'),
(5, 2, 'Humidity Sensor', 'humidity', '65', '%', '2026-08-05 12:19:36', 0, '2026-08-05 09:31:36'),
(6, 2, 'Cold Storage', 'temperature', '4.2', '°C', '2026-08-05 12:11:36', 0, '2026-08-05 09:31:36'),
(7, 3, 'Server Room Temp', 'temperature', '23.8', '°C', '2026-08-05 12:24:36', 0, '2026-08-05 09:31:36'),
(8, 3, 'CPU Usage', 'cpu_usage', '45', '%', '2026-08-05 12:28:36', 0, '2026-08-05 09:31:36'),
(9, 3, 'Network Traffic', 'bandwidth', '125', 'Mbps', '2026-08-05 12:17:36', 0, '2026-08-05 09:31:36'),
(10, 4, 'Solar Panel 1', 'output', '5.2', 'kW', '2026-08-05 12:25:36', 0, '2026-08-05 09:31:36'),
(11, 4, 'Solar Panel 2', 'output', '4.8', 'kW', '2026-08-05 12:20:36', 0, '2026-08-05 09:31:36'),
(12, 4, 'Battery Level', 'charge_level', '78', '%', '2026-08-05 12:13:36', 0, '2026-08-05 09:31:36'),
(25, 1, 'Temperature Sensor 1', 'temperature', '24.5', '°C', '2026-08-05 12:31:27', 0, '2026-08-05 09:36:27'),
(26, 1, 'Energy Monitor', 'power_consumption', '145.2', 'kWh', '2026-08-05 12:26:27', 0, '2026-08-05 09:36:27'),
(27, 1, 'Production Line', 'output_rate', '87', 'units/hour', '2026-08-05 12:21:27', 0, '2026-08-05 09:36:27'),
(28, 2, 'Temperature Sensor 2', 'temperature', '22.1', '°C', '2026-08-05 12:28:27', 0, '2026-08-05 09:36:27'),
(29, 2, 'Humidity Sensor', 'humidity', '65', '%', '2026-08-05 12:24:27', 0, '2026-08-05 09:36:27'),
(30, 2, 'Cold Storage', 'temperature', '4.2', '°C', '2026-08-05 12:16:27', 0, '2026-08-05 09:36:27'),
(31, 3, 'Server Room Temp', 'temperature', '23.8', '°C', '2026-08-05 12:29:27', 0, '2026-08-05 09:36:27'),
(32, 3, 'CPU Usage', 'cpu_usage', '45', '%', '2026-08-05 12:33:27', 0, '2026-08-05 09:36:27'),
(33, 3, 'Network Traffic', 'bandwidth', '125', 'Mbps', '2026-08-05 12:22:27', 0, '2026-08-05 09:36:27'),
(34, 4, 'Solar Panel 1', 'output', '5.2', 'kW', '2026-08-05 12:30:27', 0, '2026-08-05 09:36:27'),
(35, 4, 'Solar Panel 2', 'output', '4.8', 'kW', '2026-08-05 12:25:27', 0, '2026-08-05 09:36:27'),
(36, 4, 'Battery Level', 'charge_level', '78', '%', '2026-08-05 12:18:27', 0, '2026-08-05 09:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `match_score` decimal(5,2) DEFAULT 0.00,
  `sector_match` decimal(5,2) DEFAULT 0.00,
  `investment_match` decimal(5,2) DEFAULT 0.00,
  `technology_match` decimal(5,2) DEFAULT 0.00,
  `growth_match` decimal(5,2) DEFAULT 0.00,
  `sustainability_match` decimal(5,2) DEFAULT 0.00,
  `status` enum('pending','accepted','rejected','introduced','negotiating','closed') DEFAULT 'pending',
  `introduced_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `enterprise_id`, `investor_id`, `match_score`, `sector_match`, `investment_match`, `technology_match`, `growth_match`, `sustainability_match`, `status`, `introduced_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 91.00, 95.00, 90.00, 88.00, 92.00, 90.00, 'accepted', '2026-01-15', 'Excellent match for manufacturing growth', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(2, 1, 1, 78.00, 85.00, 75.00, 80.00, 72.00, 78.00, 'pending', '2026-02-01', 'Initial discussion phase', '2026-08-05 09:26:55', '2026-08-05 11:04:29'),
(3, 1, 1, 65.00, 70.00, 60.00, 68.00, 62.00, 65.00, 'rejected', NULL, 'Investment criteria not aligned', '2026-08-05 09:26:55', '2026-08-05 11:04:29'),
(4, 2, 1, 82.00, 88.00, 80.00, 85.00, 78.00, 79.00, 'introduced', '2026-01-20', 'Introduction meeting scheduled', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(5, 2, 4, 89.00, 92.00, 88.00, 90.00, 85.00, 90.00, 'accepted', '2026-02-10', 'Deal closed successfully!', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(6, 2, 5, 75.00, 80.00, 72.00, 78.00, 70.00, 75.00, 'negotiating', '2026-01-25', 'Negotiating terms of investment', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(7, 3, 1, 95.00, 98.00, 95.00, 96.00, 92.00, 94.00, 'negotiating', '2026-02-05', 'Due diligence in progress', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(8, 3, 1, 88.00, 90.00, 85.00, 92.00, 80.00, 87.00, 'accepted', '2026-01-30', 'Strong tech match, moving forward', '2026-08-05 09:26:55', '2026-08-05 11:04:29'),
(9, 3, 4, 82.00, 85.00, 80.00, 88.00, 75.00, 82.00, 'pending', '2026-02-10', 'Awaiting response from investor', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(10, 4, 1, 76.00, 80.00, 72.00, 78.00, 70.00, 80.00, 'introduced', '2026-01-18', 'Introduction made through platform', '2026-08-05 09:26:55', '2026-08-05 09:26:55'),
(11, 4, 1, 92.00, 95.00, 90.00, 88.00, 92.00, 95.00, 'accepted', '2026-02-01', 'Excellent sustainability match', '2026-08-05 09:26:55', '2026-08-05 11:04:29'),
(12, 4, 1, 85.00, 88.00, 82.00, 85.00, 80.00, 90.00, 'pending', '2026-02-08', 'Investor showing strong interest', '2026-08-05 09:26:55', '2026-08-05 11:04:29'),
(26, 1, 1, 91.00, 95.00, 90.00, 88.00, 92.00, 90.00, 'accepted', '2026-01-15', 'Excellent match for manufacturing growth', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(27, 1, 1, 78.00, 85.00, 75.00, 80.00, 72.00, 78.00, 'pending', '2026-02-01', 'Initial discussion phase', '2026-08-05 09:30:28', '2026-08-05 11:04:29'),
(28, 1, 1, 65.00, 70.00, 60.00, 68.00, 62.00, 65.00, 'rejected', NULL, 'Investment criteria not aligned', '2026-08-05 09:30:28', '2026-08-05 11:04:29'),
(29, 2, 1, 82.00, 88.00, 80.00, 85.00, 78.00, 79.00, 'introduced', '2026-01-20', 'Introduction meeting scheduled', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(30, 2, 4, 89.00, 92.00, 88.00, 90.00, 85.00, 90.00, 'accepted', '2026-02-10', 'Deal closed successfully!', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(31, 2, 5, 75.00, 80.00, 72.00, 78.00, 70.00, 75.00, 'negotiating', '2026-01-25', 'Negotiating terms of investment', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(32, 3, 1, 95.00, 98.00, 95.00, 96.00, 92.00, 94.00, 'negotiating', '2026-02-05', 'Due diligence in progress', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(33, 3, 1, 88.00, 90.00, 85.00, 92.00, 80.00, 87.00, 'accepted', '2026-01-30', 'Strong tech match, moving forward', '2026-08-05 09:30:28', '2026-08-05 11:04:29'),
(34, 3, 4, 82.00, 85.00, 80.00, 88.00, 75.00, 82.00, 'pending', '2026-02-10', 'Awaiting response from investor', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(35, 4, 1, 76.00, 80.00, 72.00, 78.00, 70.00, 80.00, 'introduced', '2026-01-18', 'Introduction made through platform', '2026-08-05 09:30:28', '2026-08-05 09:30:28'),
(36, 4, 1, 92.00, 95.00, 90.00, 88.00, 92.00, 95.00, 'accepted', '2026-02-01', 'Excellent sustainability match', '2026-08-05 09:30:28', '2026-08-05 11:04:29'),
(37, 4, 1, 85.00, 88.00, 82.00, 85.00, 80.00, 90.00, 'pending', '2026-02-08', 'Investor showing strong interest', '2026-08-05 09:30:28', '2026-08-05 11:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `type`, `title`, `message`, `link`, `is_read`, `created_at`) VALUES
(1, 1, 'system', 'Welcome to AIIIIS', 'Welcome to the AI-Powered Industrial Innovation and Investment Intelligence System!', NULL, 0, '2026-08-04 19:56:12'),
(2, 3, 'match', 'New Investor Match', 'East Africa Capital Partners is interested in your enterprise.', NULL, 0, '2026-08-04 19:56:12'),
(3, 4, 'match', 'New Enterprise Match', 'Kigali Manufacturing Ltd matches your investment criteria.', NULL, 0, '2026-08-04 19:56:12'),
(4, 1, 'system', 'System Update', 'AIIIIS platform has been updated with new features.', NULL, 1, '2026-08-04 19:56:12'),
(5, 1, 'system', 'Welcome to AIIIIS', 'Welcome to the AI-Powered Industrial Innovation and Investment Intelligence System!', '/dashboard', 0, '2026-08-05 09:37:37'),
(6, 1, 'match', 'New Enterprise Match', 'Tech Hub Rwanda matches your investment criteria.', '/admin/matches', 0, '2026-08-05 09:37:37'),
(7, 1, 'match', 'Investment Opportunity', 'Green Energy Solutions is seeking $3M in funding.', '/admin/matches', 0, '2026-08-05 09:37:37'),
(8, 49, 'system', 'System Update', 'AIIIIS platform has been updated with new features.', '/dashboard', 1, '2026-08-05 09:37:37'),
(9, 50, 'engagement', 'New Advisory Request', 'You have a new advisory request from Kigali Manufacturing Ltd.', '/expert/advisory', 0, '2026-08-05 09:37:37'),
(10, 51, 'verification', 'Enterprise Verification', 'Tech Hub Rwanda requires verification.', '/expert/verifications', 0, '2026-08-05 09:37:37'),
(11, 52, 'engagement', 'Training Request', 'AgriTech Solutions requests training on new technologies.', '/expert/advisory', 0, '2026-08-05 09:37:37'),
(12, 54, 'match', 'New Investor Match', 'East Africa Capital Partners is interested in your enterprise.', '/enterprise/matches', 0, '2026-08-05 09:37:37'),
(13, 54, 'system', 'Profile Update', 'Your enterprise ranking has been updated.', '/enterprise/ranking', 1, '2026-08-05 09:37:37'),
(14, 55, 'match', 'New Investment Opportunity', 'Rwanda Investment Fund is interested in your business.', '/enterprise/matches', 0, '2026-08-05 09:37:37'),
(15, 56, 'match', 'New Investor Match', 'You have a new investor match.', '/enterprise/matches', 0, '2026-08-05 09:37:37'),
(16, 64, 'match', 'New Enterprise Match', 'Tech Hub Rwanda matches your investment criteria.', '/investor/matches', 0, '2026-08-05 09:37:37'),
(17, 64, 'system', 'Deal Update', 'Your deal with Kigali Manufacturing Ltd is progressing.', '/investor/deals', 0, '2026-08-05 09:37:37'),
(18, 65, 'match', 'Investment Opportunity', 'Green Energy Solutions is seeking investment.', '/investor/matches', 0, '2026-08-05 09:37:37'),
(19, 66, 'match', 'New Match', 'AgriTech Solutions matches your investment profile.', '/investor/matches', 0, '2026-08-05 09:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `saved_enterprises`
--

CREATE TABLE `saved_enterprises` (
  `saved_id` int(11) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_enterprises`
--

INSERT INTO `saved_enterprises` (`saved_id`, `investor_id`, `enterprise_id`, `created_at`) VALUES
(1, 1, 1, '2026-08-06 10:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `sector_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`sector_id`, `name`, `description`, `created_at`) VALUES
(1, 'Agribusiness', 'Agricultural processing and food production', '2026-08-04 19:56:08'),
(2, 'Manufacturing', 'Industrial manufacturing and production', '2026-08-04 19:56:08'),
(3, 'Technology', 'ICT, software, and digital services', '2026-08-04 19:56:08'),
(4, 'Construction', 'Building and infrastructure development', '2026-08-04 19:56:08'),
(5, 'Energy', 'Power generation and renewable energy', '2026-08-04 19:56:08'),
(6, 'Mining', 'Mineral extraction and processing', '2026-08-04 19:56:08'),
(7, 'Tourism', 'Hospitality and travel services', '2026-08-04 19:56:08'),
(8, 'Financial Services', 'Banking, insurance, and fintech', '2026-08-04 19:56:08'),
(9, 'Healthcare', 'Medical services and pharmaceuticals', '2026-08-04 19:56:08'),
(10, 'Education', 'Training and educational services', '2026-08-04 19:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('administrator','nirda_expert','enterprise','investor','government','analyst') NOT NULL DEFAULT 'enterprise',
  `profile_image` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token` varchar(100) DEFAULT NULL,
  `default_password` varchar(255) DEFAULT NULL,
  `must_change_password` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `profile_image`, `phone`, `is_active`, `is_verified`, `verification_token`, `default_password`, `must_change_password`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@aiiiis.rw', '$2y$10$v/UKmtzObfqNq47ibUGWIuRzqlusE8Yn.sk3P4iAJvh12LGbatKiK', 'administrator', NULL, '+250 788 000 001', 1, 0, NULL, NULL, 0, '2026-08-12 13:28:35', '2026-08-04 19:56:11', '2026-08-12 10:28:35'),
(2, 'NIRDA Expert', 'expert@aiiiis.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nirda_expert', NULL, '+250 788 000 002', 1, 0, NULL, NULL, 1, NULL, '2026-08-04 19:56:11', '2026-08-04 19:56:11'),
(3, 'Enterprise User', 'enterprise@aiiiis.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 000 003', 1, 0, NULL, NULL, 1, NULL, '2026-08-04 19:56:11', '2026-08-04 19:56:11'),
(4, 'Investor User', 'investor@aiiiis.rw', '$2y$10$NjMzo.l7InmahC566pQFy.EdBtOy5n1pJx5rgBrMXK/J7eRXwYCTS', 'investor', NULL, '+250 788 000 004', 1, 0, NULL, NULL, 1, '2026-08-12 12:42:34', '2026-08-04 19:56:11', '2026-08-12 09:42:34'),
(5, 'Government User', 'government@aiiiis.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'government', NULL, '+250 788 000 005', 1, 0, NULL, NULL, 1, NULL, '2026-08-04 19:56:11', '2026-08-04 19:56:11'),
(6, 'Analyst User', 'analyst@aiiiis.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'analyst', NULL, '+250 788 000 006', 1, 0, NULL, NULL, 1, NULL, '2026-08-04 19:56:11', '2026-08-04 19:56:11'),
(49, 'System Manager', 'manager@aiiiis.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'administrator', NULL, '+250 788 000 002', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(50, 'Dr. Alice Mbabazi', 'alice.mbabazi@nirda.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nirda_expert', NULL, '+250 788 000 010', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(51, 'Eng. James Kagame', 'james.kagame@nirda.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nirda_expert', NULL, '+250 788 000 011', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(52, 'Dr. Grace Uwimana', 'grace.uwimana@nirda.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nirda_expert', NULL, '+250 788 000 012', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(53, 'Eng. Patrick Ndayisaba', 'patrick.ndayisaba@nirda.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nirda_expert', NULL, '+250 788 000 013', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(54, 'Kigali Manufacturing Ltd', 'info@kigalimanufacturing.rw', '$2y$10$sizhymLxx2RoknY7h.Gk8uvBOOBWmjGbfPVUYgncGMKZRWPyuMf0y', 'enterprise', NULL, '+250 788 123 001', 1, 0, NULL, NULL, 1, '2026-08-11 10:06:12', '2026-08-05 09:14:56', '2026-08-11 07:06:12'),
(55, 'Rwanda Agri-Processors', 'info@rwandaagri.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 002', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(56, 'Tech Hub Rwanda', 'info@techhub.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 003', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(57, 'Green Energy Solutions', 'info@greenenergy.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 004', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(58, 'Rwanda Textile Mills', 'info@rwandatextile.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 005', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(59, 'AgriTech Solutions', 'info@agritech.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 006', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(60, 'Rwanda Construction Ltd', 'info@rwandaconstruction.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 007', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(61, 'Kivu Energy Solutions', 'info@kivuenergy.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 008', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(62, 'Rwanda Fintech Ltd', 'info@rwandafintech.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 009', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(63, 'Mountain Tourism Rwanda', 'info@mountaintourism.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enterprise', NULL, '+250 788 123 010', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(64, 'East Africa Capital Partners', 'info@eacapital.rw', '$2y$10$vu21hh1uzd7HxOhLQagLz.xAlg5njmuHT2FN1ldvTE3067Uqpg0/e', 'investor', NULL, '+250 788 200 001', 1, 0, NULL, NULL, 1, '2026-08-05 13:44:30', '2026-08-05 09:14:56', '2026-08-05 10:44:30'),
(65, 'Rwanda Investment Fund', 'info@rifund.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'investor', NULL, '+250 788 200 002', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(66, 'GreenTech Ventures', 'info@greentech.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'investor', NULL, '+250 788 200 003', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(67, 'African Innovation Fund', 'info@africaninnovation.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'investor', NULL, '+250 788 200 004', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(68, 'Rwanda Development Bank', 'info@rdb.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'investor', NULL, '+250 788 200 005', 1, 0, NULL, NULL, 1, '2026-08-05 12:14:56', '2026-08-05 09:14:56', '2026-08-05 09:14:56'),
(72, 'nina umukundwa', 'baberybeauty@gmail.com', '$2y$10$x.uLRcVfNCCrh.ZCBE3/kOfnruNOPxdPyhSVcmxPtuBfZUEAVJb.2', 'enterprise', NULL, '0725096679', 1, 0, 'f5c4b80e3e7aab641d8fae9bc807c6500e29316576bc5518738cd292da59d910', '$2y$10$RPBR5Om0Tl2YSfwZHVjO0uDtGrR.PvFVTCVsjh6Sl6Ahr/.SKwFCO', 1, NULL, '2026-08-10 07:53:56', '2026-08-10 07:53:56'),
(73, 'nina umukundwa', 'ninaumukundwa@gmail.com', '$2y$10$.cG5mRDj3gmVcMadJldDG.JIj6kzjPRxsFWbAlwmbXlBlgFw6qX2y', 'enterprise', NULL, '0725096678', 1, 1, NULL, '$2y$10$bYEFkNkUJZ3lpe3c04Dk3eQta7H70tAnXuP0Jnryo7AdxNESLNLfq', 1, NULL, '2026-08-10 08:19:33', '2026-08-11 04:27:12'),
(74, 'niventra zyveron', 'ninababery@gmail.com', '$2y$10$NJUWnw.nuqSqkzMfiU.kMeLgZ39vmgaXrQnLW7hvkqApSxRoo3Wfi', 'enterprise', NULL, '0725096678', 1, 0, '721a7c3bc160c4b0e351cba2764149fd740612e73291fbc20063a2e6f46bf3fc', '$2y$10$UowsYIeJVpDNb9EIfOKwTuLNdUzS4LXzd3JJlDwpyxt2542k5I2/m', 1, NULL, '2026-08-11 04:52:09', '2026-08-11 05:06:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisory_requests`
--
ALTER TABLE `advisory_requests`
  ADD PRIMARY KEY (`advisory_id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `expert_id` (`expert_id`);

--
-- Indexes for table `chatbot_knowledge`
--
ALTER TABLE `chatbot_knowledge`
  ADD PRIMARY KEY (`knowledge_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `chatbot_unanswered`
--
ALTER TABLE `chatbot_unanswered`
  ADD PRIMARY KEY (`unanswered_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`deal_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `investor_id` (`investor_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `engagements`
--
ALTER TABLE `engagements`
  ADD PRIMARY KEY (`engagement_id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `expert_id` (`expert_id`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_date` (`date`);

--
-- Indexes for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`enterprise_id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_sector` (`sector`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `enterprise_rankings`
--
ALTER TABLE `enterprise_rankings`
  ADD PRIMARY KEY (`ranking_id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `idx_total_score` (`total_score`),
  ADD KEY `idx_ranking_date` (`ranking_date`);

--
-- Indexes for table `experts`
--
ALTER TABLE `experts`
  ADD PRIMARY KEY (`expert_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_availability` (`availability`);

--
-- Indexes for table `helpdesk_requests`
--
ALTER TABLE `helpdesk_requests`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Indexes for table `helpdesk_responses`
--
ALTER TABLE `helpdesk_responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `investment_requests`
--
ALTER TABLE `investment_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`investor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_type` (`type`);

--
-- Indexes for table `iot_data`
--
ALTER TABLE `iot_data`
  ADD PRIMARY KEY (`sensor_id`),
  ADD KEY `idx_enterprise` (`enterprise_id`),
  ADD KEY `idx_timestamp` (`timestamp`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `investor_id` (`investor_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_match_score` (`match_score`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `idx_user_read` (`user_id`,`is_read`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `saved_enterprises`
--
ALTER TABLE `saved_enterprises`
  ADD PRIMARY KEY (`saved_id`),
  ADD UNIQUE KEY `unique_saved` (`investor_id`,`enterprise_id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`sector_id`),
  ADD KEY `idx_name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisory_requests`
--
ALTER TABLE `advisory_requests`
  MODIFY `advisory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatbot_knowledge`
--
ALTER TABLE `chatbot_knowledge`
  MODIFY `knowledge_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chatbot_unanswered`
--
ALTER TABLE `chatbot_unanswered`
  MODIFY `unanswered_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `message_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `engagements`
--
ALTER TABLE `engagements`
  MODIFY `engagement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `enterprise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `enterprise_rankings`
--
ALTER TABLE `enterprise_rankings`
  MODIFY `ranking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `experts`
--
ALTER TABLE `experts`
  MODIFY `expert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `helpdesk_requests`
--
ALTER TABLE `helpdesk_requests`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `helpdesk_responses`
--
ALTER TABLE `helpdesk_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investment_requests`
--
ALTER TABLE `investment_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `investor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `iot_data`
--
ALTER TABLE `iot_data`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `saved_enterprises`
--
ALTER TABLE `saved_enterprises`
  MODIFY `saved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisory_requests`
--
ALTER TABLE `advisory_requests`
  ADD CONSTRAINT `advisory_requests_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advisory_requests_ibfk_2` FOREIGN KEY (`expert_id`) REFERENCES `experts` (`expert_id`) ON DELETE SET NULL;

--
-- Constraints for table `deals`
--
ALTER TABLE `deals`
  ADD CONSTRAINT `deals_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deals_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deals_ibfk_3` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`investor_id`) ON DELETE CASCADE;

--
-- Constraints for table `engagements`
--
ALTER TABLE `engagements`
  ADD CONSTRAINT `engagements_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `engagements_ibfk_2` FOREIGN KEY (`expert_id`) REFERENCES `experts` (`expert_id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD CONSTRAINT `enterprises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_rankings`
--
ALTER TABLE `enterprise_rankings`
  ADD CONSTRAINT `enterprise_rankings_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE;

--
-- Constraints for table `experts`
--
ALTER TABLE `experts`
  ADD CONSTRAINT `experts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `helpdesk_requests`
--
ALTER TABLE `helpdesk_requests`
  ADD CONSTRAINT `helpdesk_requests_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE;

--
-- Constraints for table `helpdesk_responses`
--
ALTER TABLE `helpdesk_responses`
  ADD CONSTRAINT `helpdesk_responses_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `helpdesk_requests` (`ticket_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `helpdesk_responses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `investment_requests`
--
ALTER TABLE `investment_requests`
  ADD CONSTRAINT `investment_requests_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE;

--
-- Constraints for table `investors`
--
ALTER TABLE `investors`
  ADD CONSTRAINT `investors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `iot_data`
--
ALTER TABLE `iot_data`
  ADD CONSTRAINT `iot_data_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`investor_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_enterprises`
--
ALTER TABLE `saved_enterprises`
  ADD CONSTRAINT `saved_enterprises_ibfk_1` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`investor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_enterprises_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`enterprise_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
