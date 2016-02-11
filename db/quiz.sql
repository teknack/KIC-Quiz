-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2016 at 04:48 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kic_quiz`
--
CREATE DATABASE IF NOT EXISTS `kic_quiz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kic_quiz`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option1` varchar(40) NOT NULL,
  `option2` varchar(40) NOT NULL,
  `option3` varchar(40) NOT NULL,
  `option4` varchar(40) NOT NULL,
  `right_ans` int(11) NOT NULL,
  `trashed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `option1`, `option2`, `option3`, `option4`, `right_ans`, `trashed`) VALUES
(1, 1, '6! ways', '5! ways', '7! ways', '30 ways', 1, 0),
(2, 2, '24', '256', '10', '30', 1, 0),
(3, 3, '36', '30', '15', '4', 1, 0),
(4, 4, '35-1', '35', '53-1', '53', 1, 0),
(5, 5, '5', '10', '15', '150', 1, 0),
(6, 6, 'Irrational numbers', 'Whole numbers', 'Real numbers', 'Integers', 1, 0),
(7, 7, 'Has a unique value 64', 'None of the given options is true', 'Is an irrational number', 'Has a unique value 24', 1, 0),
(8, 8, '', '', '', '', 1, 0),
(9, 9, '6 cm', '15 cm', '3 cm', '12 cm', 1, 0),
(10, 10, '26', '27', 'None of the above', '45', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(512) NOT NULL,
  `trashed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `trashed`) VALUES
(1, 'Six friends, Alan, Birdie, Cheryl, Cole, Tamp and Brandon have to be seated on a round table to play a game of cards. In how many ways can they take their seat', 0),
(2, 'Using the given five digits, 1,3,0,9,8, as many five-digit numbers as possible are formed without repeating any of the digits. Of all the numbers formed, how many are perfectly divisible by the number 10?', 0),
(3, 'In a park, there are nine swings, which are as follows: four see-saws, three slides and two rides. John wants to play on these in such a way that he plays on two swings, and none of them is a slide. How many choices does he have?', 0),
(4, 'Three toys have to be distributed among five children. In how many ways can this be done, if there are no constraints on number of toys a child can get?', 0),
(5, 'Air contains approximately 0.0003% Helium by volume. If the volume of air taken for sampling is 5000 L, then what is the volume of helium present in it?', 0),
(6, 'Natural numbers, which are also known as counting numbers, are not a subset of which of the following types of numbers?', 0),
(7, 'The square root of 1024:', 0),
(8, 'A circular park is completely covered with grass. What is the circumference of the circular park if the area covered by the grass is 400?', 0),
(9, 'A paper is in the shape of a right angled triangle. The base of the triangle is 5 cm and its area is 30 cm2. What is its height?', 0),
(10, 'If the angles of a quadrilateral are . Find the third angle in the sequence.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `ans_json` varchar(512) NOT NULL DEFAULT '[0,0,0,0,0,0,0,0,0,0]',
  `end` tinyint(1) NOT NULL DEFAULT '0',
  `main_score` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trashed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
