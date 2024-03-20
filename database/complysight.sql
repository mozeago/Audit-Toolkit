-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 04:04 PM
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
-- Database: `complysight`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `controls`
--

CREATE TABLE `controls` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `section_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controls`
--

INSERT INTO `controls` (`id`, `name`, `section_id`, `created_at`, `updated_at`) VALUES
('020eaa45-2636-4456-98d6-1af7e4bc2f11', 'consectetur', 'e80bed5d-9819-4b66-9ae0-c9d03fe1b1fa', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('022ce78a-7d0b-4766-ad7d-0c4c63de830f', 'excepturi', '36ca12e9-d9df-43aa-8316-f0ee4a734b72', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('061ce6e5-02c5-46f3-a01f-ff5d175fedfe', 'tempore', '90445daf-c5dc-4114-a1a5-e93ccf2fa21e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('07a1ec83-dc41-4952-8930-236df1d199fa', 'iure', 'c410f781-b79b-4fad-84e5-6b72a1534e8d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('07c6bc87-21ba-459f-94a5-26a52ab883ae', 'sunt', '536cfe3c-e63b-4cf6-8ce8-c64e163a8f7f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0ab70944-e239-4012-b9c7-349d1559f02b', 'fugiat', 'be7c3aca-4334-464b-9d20-b3ef2ceb779e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0b8a17ab-d18d-42be-bc08-8219b0e59253', 'expedita', 'b5a4602e-ff0c-42e8-affc-ae009c46209a', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0cec55ba-7248-472e-a8df-d9a373391c69', 'vitae', '27d7403f-848e-40af-bc3a-e3dd05e3fce5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0d36d550-e9c5-49b8-b75b-95261cf992d0', 'aperiam', 'b1655f37-6290-472a-8203-96e349ac968e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0de12303-36d5-4281-804e-55d53d16eb6d', 'qui', 'a04295e9-20c2-42bd-90cc-64e3b96e6d5d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0ed21e7c-ffab-4db8-81fd-8c8965a57893', 'magni', 'b3fde131-179d-4bd4-addb-5ddcc01b1b3c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('1557e596-7e0c-49b4-85d9-849a146eb9a9', 'voluptatibus', '73e55006-d317-45ee-a76b-31f707ac5682', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('1637e668-3451-4070-8e85-42e2b8ccadd8', 'voluptas', '580fdd67-34be-43d3-adb2-edbebf66d508', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('16b1ffa1-6b0e-4606-948d-1e31a017afee', 'natus', 'b4b6922b-fd20-4322-a251-288fa9f3e100', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('1ad75fc2-b295-4294-bec0-3923281695a5', 'occaecati', 'e9a41ab0-fbad-4a3e-93c5-6e0b55f5b884', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('1db03b39-ba94-40a8-a1aa-99851459cdff', 'eligendi', '508812cc-97b9-4492-91fb-894a44948642', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('1dc8f94d-d341-49ee-8c18-69164fb39b3f', 'non', '8fcd2825-636b-42a8-97eb-e9184519d80c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2519282a-7e53-47f0-9aef-576db2f4a529', 'modi', '275f0ac0-6f42-4df7-958c-014d9d414b0d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2c7c8590-9abf-4ccb-a466-111e6d3a9981', 'commodi', 'd00e76d5-6834-4a40-bce4-3afbd898a6df', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2da272d2-a444-4b45-8a2d-5732baef38d0', 'dicta', '374c5b2a-99e6-4e67-a4f9-7241b9ca23a8', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('2f906ba0-c405-4e4a-85f6-1d8123064257', 'repudiandae', '592208a0-ff45-4704-9f96-29eb3989ce1f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('30ec93b4-405c-4429-9437-d28432b157fe', 'animi', 'e4aa4b6a-e612-4dc7-90d2-d2fdab9e3770', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('3271d336-b59d-4622-b9f3-ee7fe0925e27', 'mollitia', 'f2861dab-76c0-4aa4-8704-98d987d0e456', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('339e21a0-d08d-4641-850b-224dd14be7d3', 'omnis', '0ff4b912-4dc7-4bef-821c-35741b83981f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('33fda936-daa3-4c67-8962-9ffd8d9aae31', 'fugiat', '8789fb5d-db6f-49c1-84dd-91f033c59787', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3411317b-a7e0-48a9-b0a1-5722a2ac25df', 'molestiae', 'd26fadb1-b537-4fdd-bfb6-52fa57215b3f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3584e77e-351f-4326-920a-19e7a45c3fff', 'quod', '149811c8-7075-4149-b555-058edb901cc2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('36bd1e74-f4cc-4d2a-99ef-5728aa1c75cb', 'et', 'e6985329-29f9-4aef-a0ff-7eacc6cbe89c', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('377acce8-269a-45a5-aa5c-a305032aa5a8', 'quod', '374c5b2a-99e6-4e67-a4f9-7241b9ca23a8', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('39a52e8a-ef69-41a0-b3d7-4bb6da4537de', 'mollitia', '6ab49f53-ac26-428c-99ea-03a0413d97a7', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3a8f4a7f-133b-43c0-b5ad-36f2531ebf9d', 'et', '5496cfa1-94a5-4e5f-a116-6bb4ef8eddd9', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3d012d4d-5bc3-4b9e-aa26-51c04c0c749b', 'quis', 'fd013310-afb6-4572-9a94-d607c7572e3a', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3e399776-7bc3-45c2-997c-ad4ee50e836a', 'modi', '15ba1b6b-017d-438e-b234-2d7af45c91b8', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3ef5f6a9-2bce-4e23-baea-2d087d2ef2b5', 'enim', '50302c4b-bb1d-49b8-af64-0552fa4777c1', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('432f24ab-2984-4c4f-8c7a-7bf668e66219', 'recusandae', '8bfb65b7-9181-46fb-9ec4-75817640caeb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('475bc0ed-bb54-4df6-a872-a24d21a4203c', 'doloribus', '66f1e4b2-cad0-4b29-bac6-c85fb0baf0d3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('49a6bfa8-70b7-404a-802c-f0e930179cee', 'nulla', 'e25c4486-a0d2-445d-963d-571d9f2af5fe', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4a5c1bc4-60fc-4c12-bf4b-f149bd2529ce', 'dolores', 'd1445b2f-9883-41e9-875e-b0bf243a89f7', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4aa27861-a99f-4180-bd07-37b0d311d362', 'impedit', 'ca0f45a7-0bc6-40fc-9667-5a3a996fdef1', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4f2c95a7-ee8d-4493-bec9-2944bc76a547', 'quidem', '580fdd67-34be-43d3-adb2-edbebf66d508', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('4f4a1d79-b327-4d79-8c0d-c43315e37c18', 'mollitia', 'eac936ab-275c-405e-a57c-5655b84592a4', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('528a0194-d028-4529-a4e9-1507552bd9d5', 'dolorem', 'b4b6922b-fd20-4322-a251-288fa9f3e100', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('52cd2877-563e-49b8-ba4e-6a021a2fe83a', 'debitis', '580fdd67-34be-43d3-adb2-edbebf66d508', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('558bb676-4b74-4648-850f-c7f0062abc8e', 'ut', '66f1e4b2-cad0-4b29-bac6-c85fb0baf0d3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('57b30df8-6bd6-4ea0-8cb9-261fcf1ce7b1', 'autem', 'b1d4fc6c-9a24-4799-a732-3414d0aa78c9', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('590031b1-3345-4120-9dfc-6d6a47538953', 'ipsam', 'e4aa4b6a-e612-4dc7-90d2-d2fdab9e3770', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('59675ef2-3ffd-488b-bd63-5df88d9cb74a', 'cupiditate', 'ebd73065-675c-417b-b04a-6e21390b6b10', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5b42571d-36d5-4dce-adf3-381978b0cb8d', 'aliquam', 'bd14a978-8dcf-453a-902c-dccd24c0beae', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5b7075a4-0c1e-45a3-8cbd-e9b5d72987b2', 'eum', '7ab33f6d-b1d9-4c69-a79d-8d3f209414ee', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('615bc3c5-988d-4882-9919-1e8542f55307', 'nobis', 'e6985329-29f9-4aef-a0ff-7eacc6cbe89c', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('617879fd-1c3b-4683-a257-48287338039f', 'dicta', 'f2861dab-76c0-4aa4-8704-98d987d0e456', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('6307cdda-e4ee-41b7-9f89-6bb0806e1b3c', 'unde', '66f1e4b2-cad0-4b29-bac6-c85fb0baf0d3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6428f869-8bb4-491e-8b5a-3a43a2578b35', 'et', '4b6427bc-610e-4ecd-9873-0e84dc264dbc', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('642a236a-570f-4357-a1eb-fdd568957c1f', 'distinctio', 'd371daec-1056-4a14-908d-38b8ccd1d9c8', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6485936b-0b15-404a-a950-8d0fc69c91c5', 'officia', '7a6b3dfa-8f39-4e38-ba32-c398cd22c7e8', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('666b7f34-02b4-48c4-8c9f-b58d0b20d9df', 'rem', 'f2861dab-76c0-4aa4-8704-98d987d0e456', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('66ab2796-fe39-4684-b4b7-cb82d6510f94', 'aliquid', '374c5b2a-99e6-4e67-a4f9-7241b9ca23a8', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('6c2d88a0-d6d5-4735-9938-82e61b1a2c76', 'adipisci', '87da04fc-d684-47b4-a63a-cd6b94301979', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6d0f37eb-fe75-4990-9720-85493e391c21', 'laborum', 'e4aa4b6a-e612-4dc7-90d2-d2fdab9e3770', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('6d8754ae-42b5-4bcd-96f1-ac9ad4316738', 'accusamus', 'b4b6922b-fd20-4322-a251-288fa9f3e100', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('6fc5c4d0-7aac-4232-a41f-589eb6630a71', 'voluptates', 'bca2836f-ae06-4223-bfa1-95ed4c12f620', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('703da9bf-2f70-4d36-ade2-469d9ca63a5a', 'ratione', '309ec157-9c11-45dd-8bac-4467b8c67adf', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7750cf85-14c0-4415-8629-8e17845183e8', 'consequuntur', 'e4aa4b6a-e612-4dc7-90d2-d2fdab9e3770', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('78bf661f-4bf8-4ff1-b148-5297f40458cc', 'nihil', 'be6423c5-1040-45b4-8f5c-9ffdd44d2538', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('792771a2-31f5-468d-be44-3becb04f3621', 'odio', 'b4b6922b-fd20-4322-a251-288fa9f3e100', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('79ded810-6822-487c-8fb8-d8cee037ea3d', 'soluta', '3e117d07-2688-465b-bd65-95c8b76049a5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7a71190a-318b-4396-8210-fdb7ed2b808d', 'sit', '1bb1e11f-c5f4-4a48-82ea-21827fa16976', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7abd2db8-bce9-47fb-b5c7-779374029f5f', 'quia', 'b4b6922b-fd20-4322-a251-288fa9f3e100', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('7fafb089-ba9e-42ed-b959-a226bd5fc841', 'consequatur', 'c48197d1-ae5e-4776-8a78-863d20690288', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8079a17d-0897-43a6-8d1b-df1a5f66838b', 'omnis', 'e2961d94-e7de-4dba-938a-1fb70ac7cb16', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('81ce96b5-a6b3-4170-8847-d3baa6687841', 'culpa', '8ec0d925-88f7-4a51-8ae3-8df2d0e78a14', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('82d99842-01fd-4a9b-b399-0cc49efa5a23', 'dolorem', 'adeab5f0-f62e-4cb3-a59e-1488b5447950', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('844fe4c1-aef6-4f08-aa62-63d31eb0c3c3', 'ut', '38ce6142-4223-46cf-aff5-770e450dd94b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('855b6c68-30fe-4587-a475-7b78240efc10', 'deserunt', '75c7a0fa-dae2-4f90-8751-a91007ee1919', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8591ed49-92af-4833-a9df-e86aee8c85ed', 'nobis', '66f1e4b2-cad0-4b29-bac6-c85fb0baf0d3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('888ff6d5-3b34-412b-9c89-2304874cb6a9', 'dolor', 'f2861dab-76c0-4aa4-8704-98d987d0e456', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('89ede5a3-95b3-418c-b4ce-b2146c588cf6', 'molestiae', '9acc38b9-66ea-4830-ad1c-29375509b945', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8a760912-22ca-4ed9-b456-7a53af65863b', 'id', '0b80e74f-9426-47fc-994c-699738312cef', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8ce6dd89-35a9-4bbd-865f-346d6f7e080b', 'illum', '125767d1-2f10-4038-9e07-3b0bfc58a488', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8d7fab6d-f0d3-4685-8cd1-198eca33dd21', 'et', '374c5b2a-99e6-4e67-a4f9-7241b9ca23a8', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('919cecb5-739d-4866-adb9-8e2f6431b4b4', 'quia', '20477578-6821-4ab7-8813-844f68a2efd6', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('91b9fe6d-2598-4e6f-9351-3870877d87f2', 'at', '533ea2e2-6122-4421-b548-b0840f07cc07', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('937612f6-fc32-4565-bd65-9b872e1d8406', 'corrupti', '0ff4b912-4dc7-4bef-821c-35741b83981f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('948daf54-4dd6-444b-ba2c-b3c30cf2ced3', 'consequuntur', '0ff4b912-4dc7-4bef-821c-35741b83981f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9748f2be-f432-48c4-b125-ef25d586df6a', 'optio', '4d8d6f69-2cca-41fb-a01a-36a80a5afd68', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9828eb09-d036-4051-bf13-8457fbf9b50e', 'occaecati', '2566b938-578f-4a8d-8875-2707c84d39d0', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('98b6bdc2-b17a-4206-a516-4680ff3d0988', 'et', 'f2861dab-76c0-4aa4-8704-98d987d0e456', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('9bfd5a39-f3dc-48b8-a8b2-5c54e65c32eb', 'et', '36ca12e9-d9df-43aa-8316-f0ee4a734b72', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9c8983d5-ffca-4462-bef0-c11336f65bad', 'quibusdam', 'f7d098bf-7a68-4796-b706-9e83af61bd3f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a01c0c56-7c00-4879-8c1e-d31436192498', 'aut', '53079f30-e7b2-492c-9b8a-77e3d2b4e926', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a0be2ff6-3e18-4287-99a9-d398022ea552', 'quas', '48130e55-dece-441b-867e-ad8dadcc1ec5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a247e096-47af-4ea0-afe9-c9294150dfa2', 'aut', '0456bcce-5bf9-4b52-85fe-f7508c5acc5d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a57ca67f-549c-4f8a-a88f-15f8d7e518f1', 'sapiente', '9660595c-8271-47f2-b880-38418fd8f944', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a5efdeb6-7c2d-4186-be25-6bb44f9bab6f', 'ut', 'e7f8bc08-d5a1-4d5d-b830-31f0b3418a49', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a6f43414-85d1-48dc-aeee-d8012f8cfeb3', 'perspiciatis', '68cf8a60-9c96-45e3-ac06-34acb41c4c9f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b098f84a-ccaf-4202-a647-bfa8eef85262', 'consectetur', '0ff4b912-4dc7-4bef-821c-35741b83981f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b3baf68f-2100-4320-b9cd-071f9350b60f', 'recusandae', '374c5b2a-99e6-4e67-a4f9-7241b9ca23a8', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('b66472ac-2015-4d52-9cea-801fd0e6ca7c', 'explicabo', '7ab33f6d-b1d9-4c69-a79d-8d3f209414ee', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('b82c227b-9287-4b38-ad53-89d4732156d0', 'doloribus', '28d7bc0e-500f-47ad-94e9-edb2a182e21d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('bd5c2ac8-2cb4-4471-8a4c-3d269a9d64cb', 'sit', 'c0321e17-7dd7-4ac4-9131-763cc8a8bad2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c052d0f6-6a4f-4431-9976-6ad86931e00d', 'dolorum', 'f7ec3cf0-7ee4-4511-a925-09b4642568d3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c076872a-69ec-4b37-b599-dcab69c64ce5', 'cumque', '36ca12e9-d9df-43aa-8316-f0ee4a734b72', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c385be0e-5148-43e7-9c1f-1fa64a2b0bc3', 'unde', '5c756c54-aec4-4c2d-81a9-79fd03ab38b0', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c4a30d02-4e6b-4c13-a6d5-bf7118dd716d', 'pariatur', '0ff4b912-4dc7-4bef-821c-35741b83981f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c71148ea-d18d-4f35-87f6-9e5f3c48191e', 'totam', '62681bcb-68bc-452b-86af-4519d034e374', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c7c85b16-34e6-4ec5-a06d-eca10237454e', 'est', 'eefcd470-7cc9-48ab-9aea-4167d52dbf64', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c958a16a-cba9-4c44-ac73-c4789e37a23a', 'ea', '66f1e4b2-cad0-4b29-bac6-c85fb0baf0d3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('cbf8e017-42b4-4b0e-9ed0-1fa8e778b0a8', 'quos', '6949d2ad-7d71-4da1-8b2f-cfdf5a83b087', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('cd7abc0a-9f86-49b1-a96e-7574eaaa030f', 'dignissimos', 'e6985329-29f9-4aef-a0ff-7eacc6cbe89c', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('ce7661e3-a6c2-4887-8125-b60e8c86e6ca', 'eveniet', 'e6985329-29f9-4aef-a0ff-7eacc6cbe89c', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('cf0a7d1c-5f90-4526-9b8f-21f0dccdc046', 'nemo', '7ab33f6d-b1d9-4c69-a79d-8d3f209414ee', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('d0c5fa90-968a-4ef5-86a1-b29097ebf9a7', 'accusantium', '660653e8-cb8b-4698-8de0-eb5877d048bd', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d442b626-512d-466e-aa80-9abeeda0456d', 'necessitatibus', 'fd280509-f56d-4554-8b09-ddf8f05f4bcb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d44bb6be-bd47-4a19-9adc-35719e821117', 'unde', '7ab33f6d-b1d9-4c69-a79d-8d3f209414ee', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('d9d49340-9a3d-48cf-9210-3784d85ae9e0', 'et', '36ca12e9-d9df-43aa-8316-f0ee4a734b72', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d9d7068f-95f9-402f-9a8a-678b69a8eed1', 'neque', '7ab33f6d-b1d9-4c69-a79d-8d3f209414ee', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('e222a550-caa6-4697-b8c7-df63118645b0', 'vel', '580fdd67-34be-43d3-adb2-edbebf66d508', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('e2a8b88d-8c39-4263-b4f0-700b24ca38e7', 'repellat', '36ca12e9-d9df-43aa-8316-f0ee4a734b72', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e557478d-2a1b-4e3e-aaa4-f157cb057c59', 'quo', '991189fb-a825-4f18-99f0-1835ce415852', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e86cd768-8ac5-4ace-9ddf-afb94bf83604', 'dolorum', 'e6985329-29f9-4aef-a0ff-7eacc6cbe89c', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('ecdcccd3-c6d1-4e80-95b2-bcbf3d4380db', 'voluptas', '580fdd67-34be-43d3-adb2-edbebf66d508', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('f0536a81-8dde-4708-ba8f-bec641038b38', 'sint', 'ca2ca378-2bfc-462c-b2bc-169d15bbfaa9', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f15b72e8-e86a-46d0-a8c9-d830df3a9506', 'eius', 'e4aa4b6a-e612-4dc7-90d2-d2fdab9e3770', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('f1b1be6b-37e0-4a87-883f-f77ab8a92aea', 'nam', '41868328-350b-4308-ab46-d46ad6a99fd2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f4735cb6-4d2a-4412-abdb-dd0b259f3820', 'sed', '77ef714d-5cb4-4265-956b-31e7aa238914', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f78ef8fb-3f5e-4d00-bedd-0e076065224d', 'perferendis', 'ac10da48-ccb2-4222-b92f-4f8bb09a282e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f7f64973-fff0-462d-8a88-fa5fdc10605a', 'ut', '918002d4-f1b1-41a9-8fe9-2a512303e339', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f9427b91-8f0b-4eb8-b735-919b7c51710f', 'et', 'ed5eb6a6-e76f-472e-aab2-87645a803e2f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fc60e791-744e-4c15-b615-8fbf63c4d7a5', 'repellat', '07511b90-14c0-460f-8c0f-696aa625b576', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ff9a6765-65df-4816-ae0b-9ed8dce1e26c', 'consectetur', 'e71551aa-3223-4d1e-8796-fc95eb3b0c55', '2024-03-20 11:54:00', '2024-03-20 11:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` char(36) NOT NULL,
  `content` text NOT NULL,
  `question_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `content`, `question_id`, `created_at`, `updated_at`) VALUES
('04438ecc-aa5d-4b88-a2b2-ea3b6a729a59', 'Quae amet non molestias cumque. Error nisi omnis et error repudiandae repellendus praesentium. Qui ut odio voluptatem facere quia perspiciatis. Sed quaerat velit repudiandae nihil dolorem vel.', '15c507bd-83b4-4c3f-a51c-8b112cb563c0', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('06ffce7e-848f-4198-a4a3-b4c9b6b40c0e', 'Unde voluptas praesentium iusto blanditiis. Laboriosam qui dolor iure deleniti. Nesciunt ex consectetur cumque nesciunt id adipisci a. Nam delectus in voluptas sit.', '61062e34-ad24-41f1-9a3b-2e7fb1b8bda9', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0886e803-2679-4bb9-817a-027c7590bbdd', 'Magnam iste in minima iste ut velit. Sit tempore eum ab aliquam et veritatis debitis perspiciatis. Qui fugiat similique sit consequatur sed omnis.', '2f56bda1-9bd2-4062-84ae-5eda39e77beb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('08ba45f2-483d-4389-804b-b39ce933a6f8', 'Consequatur ad architecto optio maxime laborum corporis recusandae. Ea neque ut tempore quis natus nam. Sed consequatur omnis iusto numquam id et dolor.', 'e39cc642-37fc-45d7-94f3-e4d12261d3cb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('12304e65-f860-4ad8-8c37-d59d41eca070', 'Quia explicabo ea ut dolores. Reiciendis dolorem voluptas et debitis. Beatae tempore ea exercitationem ipsum.', 'a8277131-03a9-4e30-ae21-467a40d26449', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('128e4cf4-af55-43b9-9e6b-368693a60bac', 'Voluptas repudiandae eos tempore assumenda provident ullam. Et est iusto aliquam id delectus cumque doloremque laudantium. Ut adipisci qui ut incidunt molestias harum ab. Suscipit ut molestiae aut ratione asperiores quidem.', '2ee88feb-b69b-4df7-8f5b-4b655b487eb2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('12d007be-1692-4f46-a5a8-bdc518aa9fbd', 'Natus consequatur porro harum in culpa. Voluptatem voluptas quia est aliquid. Quo voluptatibus id nihil eum. In ut repellat est. Libero totam ea quae et odio quos.', '13046c73-0edb-4d0d-b143-490191457c8c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('17509b2d-a796-4ddc-b43b-c77cb3e7f492', 'Unde facilis at quam eos qui. Cupiditate ipsa eligendi aliquid rerum. Excepturi tempore qui perspiciatis saepe veniam deserunt omnis officia. Earum debitis dignissimos beatae illo quam.', '8db35ee0-fc7c-4553-b249-c29da79b7388', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('181be2f2-d63c-4870-be75-8bef35978ede', 'Nemo ea perferendis velit cumque et. Perferendis in officia cupiditate dolorem non minus ratione totam. Minima earum autem ut saepe repudiandae et.', 'f5219a44-ecf4-4ac8-b0de-fa3eb0190df5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('1da1d4df-98e5-4d39-b105-54c871d26111', 'Ipsam laboriosam amet ducimus. Aut eos commodi quis aut molestiae ullam maiores. Quia distinctio temporibus deserunt vero. Deleniti sed eos perferendis eos molestiae asperiores.', 'fc9309b2-11f1-4728-93a0-56a7a95e511d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('267e5cfb-a80e-4f5b-bda9-cf91187af1c8', 'Corporis sit veritatis dolore omnis natus. Dolor odio autem sint eaque. Earum sed suscipit ipsa qui est quis. Molestias atque aut aperiam consequatur et sunt molestiae.', 'c46e97cc-b510-4c90-bbd7-bcb546333d3e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('269a3abc-9bf0-4023-a79a-c77c1da91a88', 'Quis odit architecto alias quia corporis est illo quibusdam. Et in sed mollitia tenetur nihil.', 'b3fdfa6f-8133-440f-90fc-c2829d8291f2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('274b6df5-1dca-4f70-a7f1-0edc6768eeda', 'Nisi non ea illo. Debitis et voluptatibus veniam sunt consequatur non veritatis. Vero consequuntur et voluptatum pariatur. Consequatur voluptates voluptates aliquid consequatur adipisci voluptate alias quis.', '3daa965e-9b30-4ee4-a9bd-f650736c9aca', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('29339e41-4c59-4a28-a1dd-7d8996fdcb65', 'Fugit vel facere aut odit rem minus corporis. Ducimus sed molestiae cum illum sed possimus eaque dolor. Porro suscipit est quidem labore.', 'fed004a0-f50e-48b0-9ad5-065188202a18', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2c77583d-db59-4252-8e83-d21132351e10', 'Qui tenetur fugiat maiores et adipisci mollitia qui velit. Ut beatae quos iste rerum aut nisi. Ab ad eum error. Consequatur omnis omnis impedit et velit quo exercitationem.', 'a0599632-acc3-488b-80d3-d85c1feb7142', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2f7beeae-1b1b-436e-8f2a-a008915812bd', 'Tempore in perferendis repellendus accusamus cupiditate voluptas id qui. Atque nulla doloremque sint dolores officia repellat esse ab. Ipsum ratione vel quo in ut.', '23d5391e-758d-4590-b681-8c4cfded4282', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2fc7520e-cb7b-4a4e-b79b-c7365dd78d58', 'Ipsum tempora id dolores. Temporibus dicta ut illum. Eaque aut dolorem consequatur commodi consequuntur. Illum aut eos blanditiis consectetur sint ipsum.', 'a6d8fe3f-1aca-49e6-8248-b818b130953c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2fdd5093-2017-4cc3-985b-37fad56ee5a4', 'Optio nesciunt vero ut dolores facilis. Odit voluptas deserunt vitae et enim numquam magnam suscipit. Placeat eum officiis consequatur voluptas tempora. Et impedit ex optio perspiciatis necessitatibus mollitia nobis. Vel qui qui facere ducimus et praesentium.', '335024df-7a19-46cb-8e4f-1c9982d759ed', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('359e7484-ff71-4576-adef-3190a15f410c', 'Aut eum voluptatem fugiat ut. Ut sunt porro repellat soluta. Facere provident sed tempore eum omnis nesciunt enim. Eum aut aut et et voluptatem dolorem earum mollitia.', '5cd7350c-28b8-4fe8-a794-3a18683161cb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3a4085ee-d931-4c36-8475-caf293ee01c8', 'Ducimus eum cumque architecto fugiat voluptatibus cupiditate. Et hic veritatis facilis distinctio facere veritatis voluptatem. Enim aut autem illum aliquid libero et temporibus. Sit qui at nisi et qui ut ex.', '2336895a-909f-468d-8655-b7ba09ea9133', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('42a92250-2dce-4daf-a84b-1c5346fbeb02', 'Molestiae ipsam dolorum aperiam delectus at illum. Eligendi voluptas aliquam voluptas dolorem iste quaerat ut et. Dignissimos omnis tenetur illo numquam at incidunt. Asperiores doloremque ad voluptatem ut sequi.', 'c6490a40-0a8f-4b97-b490-90d54086ee02', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('47d9ef70-f989-4866-abf3-21e784212887', 'Sint harum consequatur repellendus sit rerum cumque. Dolores eaque assumenda odit.', '0f86c9cf-fa87-4463-bc81-8a0acea723f3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4a4ade97-8da6-4fb1-a260-6cfc57b0c9b7', 'Id est veniam voluptas ipsam. Dignissimos dolor eos aperiam omnis similique. Magni accusantium ut voluptas ipsa est neque.', 'feaf68bc-5b01-4338-a524-f178c8de7a41', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4cf3529e-6ad9-44d0-a47f-e563a40ed07e', 'Dolore exercitationem dolor rerum totam eaque ducimus similique. Autem ut corrupti quibusdam autem.', '2670fe17-8431-4bff-b41e-84ca2814b5cf', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('501a7469-a6e2-4bdc-a7a7-408f38548b5f', 'Qui quas in corrupti optio. Sint repellat nihil omnis qui. Modi labore explicabo omnis nostrum dolorem earum.', '520a22cb-24d1-4e2c-985e-1dc9ba0bea20', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('57cb516a-f5ff-4951-9cec-1fcd81987686', 'Pariatur non non omnis dolorem quod. Ut molestiae rem voluptates itaque dignissimos. Quia molestiae voluptas a vitae.', 'bf07b05d-779e-4a5c-b4b3-33372e5acd38', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('62669a4e-a483-4e8b-85e3-19e3f7e8622b', 'Doloribus accusamus reprehenderit ipsam fugit nobis odit tempora. Sint accusantium velit qui neque et impedit. Sed rerum nisi aut voluptates ut quis.', '63701c4b-3ad0-4132-a56c-25892ea87818', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('63f50627-4376-4989-9ba2-0ea8a5da6f66', 'Enim non et officia voluptatibus atque. Ea explicabo molestias modi nam reiciendis.', '00c658da-4559-48ef-a343-4ab801657f2d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('656ad22b-ada5-4cc6-aabb-ac3c4460248d', 'Quaerat deserunt quia omnis vel. Aut ipsum magni adipisci esse officia quo et ex. Consequatur laboriosam dicta dolor sunt incidunt possimus est. Velit aut quaerat aut omnis quo.', 'f7ed2d51-f218-46ef-b5fc-3fcf4dc2fe68', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('71bd0e92-b6b7-4d0e-bb91-2c18cf649aa3', 'Repellendus sequi non nam cumque molestias voluptatem et corporis. Consectetur aut nulla explicabo fugiat aliquam error. Excepturi et veniam reprehenderit ea. Aut quos id dignissimos et dignissimos.', 'ca6e8ede-d09d-4a6e-8faa-f48720bd3685', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7250bda1-48bd-4bb3-92d5-0113b50e5b53', 'Eum qui sed quia sed reprehenderit. Possimus odit incidunt non similique autem et. Cumque quasi deserunt quis quidem praesentium.', 'e3d3d3a6-a328-48bd-8f74-263cbd93aad6', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('75fbbded-9a13-446f-ba55-01e6306f9df1', 'Inventore est quo ut. Non repudiandae adipisci blanditiis et dolorem. Consequatur aperiam debitis culpa modi ut veniam minus. Fuga minima ipsa laborum dolores illum.', '5e759e8a-a42a-4a23-9c4e-a12d6cf67502', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7d51685e-a2aa-40a2-91cb-f285d5c00367', 'Aut quis rerum aut sit est iusto sed. Aspernatur quo quas sed tempora maiores est quam. Quia commodi maiores qui sit eveniet. Dolor vitae qui nemo sed corporis.', 'ab38bf81-8812-4c93-8c24-09bf94b3afff', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7fabcd15-383a-4168-aac7-8d59d46b9320', 'Harum cumque quod ratione laudantium debitis accusamus. Facere est doloremque rerum quisquam consequatur laboriosam. Quam dolor sit sed. Accusamus voluptas nemo veniam quia.', '9a6e99b7-d03e-4cda-9b55-e7ca1ae386b0', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('83f3cf71-0732-42f6-88b1-c510e55e0568', 'Laboriosam odit recusandae nihil sed. Ipsa maxime voluptatem facere rerum nulla aut. Debitis sed sunt vitae incidunt quo. Error et aperiam saepe dolorem omnis.', 'f97c37b8-8e2d-423c-81bd-d2454af56591', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8b9fdd8d-7e59-4691-b09e-e9951def2883', 'Laborum laborum consequuntur autem aliquam. Illo qui veritatis et ut ut qui. Distinctio deleniti impedit labore consectetur voluptate excepturi aut.', '5b3beb39-16e1-4ec4-b091-5b0f4391e2ef', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8e17accb-e8d4-4d3f-890c-48575e10d407', 'Culpa corrupti non beatae officiis laborum suscipit officiis. Facilis molestias et recusandae quidem totam minima dolores. Odit neque et consequatur expedita quia qui.', '41e819cf-08be-4aa9-9933-45c7589ee785', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('915ef625-1e8c-4fe6-9135-e0cd9894abdf', 'Dolorum laborum nulla possimus consequatur quibusdam autem. Ut est voluptatem et reiciendis adipisci commodi. Ut culpa laudantium quia consequatur tempore distinctio.', '8a9fcd15-eccf-4f3f-b90b-a63b1eafe52b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('97931dcc-23e0-4f5f-90bc-4cf9ac011e79', 'Architecto enim id dolorum expedita. Est tempore nemo aspernatur doloribus sed molestiae fugiat tenetur. Eligendi sit consectetur ab assumenda. Occaecati quos et ipsum quod velit cupiditate ducimus.', '279074a7-cfb5-4a3b-975a-c41f46f533bb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9d2dbb4e-8ff7-4a52-b5f7-d194d2b59419', 'Consequatur reprehenderit harum dolores. Velit a temporibus aliquid dolorem eum aspernatur. Enim libero in rerum aut quia alias ipsum ut. Repudiandae accusamus rerum fugiat omnis facilis dolorem. Est laborum accusantium sit omnis error.', '4c042372-3774-42ae-b3ac-2394d2db2e36', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a7a25613-dc79-4030-b0c6-6a1ee1d8bf3a', 'Tempore eos voluptatibus nisi voluptatem. Molestiae odit aut aliquid delectus voluptate molestiae. Consequatur et reprehenderit reiciendis in facere.', '74605414-5ec5-4032-b82a-87f5c28c05ff', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a9d513da-a480-41c9-bf23-14b6a55741de', 'Quidem deserunt recusandae est ex. Et nisi vel sed quas.', '80226c21-c2e3-4773-9176-f8fe21282ea1', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('aa5348ca-2d04-4ec4-ab32-4380189ec5a4', 'Sit minus dignissimos molestias deserunt facere ratione excepturi. Asperiores laudantium corrupti occaecati. Deleniti impedit aliquid iure eum cupiditate eligendi. Molestiae unde at harum molestiae pariatur sapiente quam.', '6c987f89-43b6-4efe-96f0-9f561000b86c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('aaaedaa3-daed-4d7c-8578-7f44d9ead9f6', 'Aut in impedit doloribus. Tenetur et occaecati inventore suscipit est explicabo impedit.', 'a1344a0d-6673-4598-bba7-bb451c7161ff', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ae257f1c-6af1-41f6-ab5d-56defa311ded', 'Qui ab ut laboriosam nemo eum. Natus consequatur quia ab laboriosam. Animi vel dolorum id.', 'b313ba7a-fb53-4bc2-8679-4fc1f8ae5bbc', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b9febad0-4dc1-4ede-b584-62cae8b942c0', 'Ea id dolor odio voluptatem voluptate. Voluptatem quos deserunt ipsam officia consectetur aut voluptates. In eos quia modi sint soluta voluptatem. Ut beatae ut laboriosam quam ducimus. Autem sed cumque aut quia.', '985931ae-ce9b-4471-bf6a-cf10bfd7f22c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c8fa71a8-fae5-41c4-97e2-574b01ba1ecc', 'Necessitatibus cum et enim consequatur enim consectetur quibusdam. At vitae rerum aperiam natus tenetur recusandae. Quisquam numquam enim quisquam ratione.', '5542c51d-2ee0-4e91-8a55-bad07627d446', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ce116676-78d8-450b-9aa9-e744d6c2e0aa', 'Autem est impedit delectus rerum nulla doloremque numquam natus. Atque nihil suscipit quae aliquam quia aspernatur. Nostrum aut odio totam accusantium illo. Natus reprehenderit ut dolore repellat vitae impedit.', 'debc526b-e4e3-4f64-acd7-955931617a1c', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d0e4abe0-f8d1-4e56-8519-7b771b515a3b', 'Mollitia repudiandae tenetur excepturi quasi ipsam ut dolor. Reiciendis modi culpa sed non est unde. Veniam eveniet sit saepe nulla qui nulla sint. Voluptatem ex odio aut id.', 'a2293af1-36f8-4d1a-ad3c-bdb7a3b81588', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d8ce1e4e-ee91-4e03-9d83-22662cba9ef1', 'Nam voluptas similique numquam eum. Consequatur nostrum qui eos animi itaque delectus. Magni officia aspernatur omnis sapiente magni.', 'be0a58ca-66d8-446c-9036-f0728fe68260', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ddb7bfea-7599-4c27-8dae-31d4cdcf8873', 'Sit aliquid libero eum. Illo ut assumenda quia suscipit dicta vel. Et nobis consectetur harum quidem quidem dolores officiis.', '7b21dbfb-40b7-411b-8961-ea72d3fe733b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('deb566c9-68b2-4ee8-b51c-07646d7ba304', 'Blanditiis necessitatibus tenetur doloremque. Autem laborum repellendus pariatur recusandae perferendis. Dolor molestiae non error labore omnis quas cumque.', 'afdcde2a-4481-4dac-b94a-f34a184bacf9', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e14730da-05bf-4f4e-b86e-40b993d49d28', 'Est impedit ad qui libero reprehenderit modi non aut. Nemo architecto minus in. Aliquam magnam deserunt doloremque quam rem dignissimos recusandae. Et doloremque placeat blanditiis saepe. Quia nihil sed nam ea ea neque odit.', 'a14592db-4791-4e43-a241-8e74a179ff96', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e433b8ac-636e-4b52-9b08-2504bd684026', 'Quam alias voluptas ut tempora fuga. Aliquam sit ut consequuntur sint aperiam. Fuga totam est reiciendis in totam perspiciatis. Nihil molestiae aspernatur voluptatibus qui est.', '6a09a15d-de08-4d7a-a401-240d7acf2060', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('eaa85877-1ff8-4bef-b7bb-da789c1d2199', 'Aut occaecati voluptas sed id excepturi ea tempora. Quo neque velit porro quam perspiciatis dolore occaecati. Nam eveniet aut iure quia est eius optio. Aspernatur sit odio est dolorum quos. Aut eum similique eum ut.', 'fa6e2c6a-3477-49ab-b711-012f0ab6ecbc', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ed068cea-f301-4a55-b373-55280a50bda7', 'Ea doloremque modi facilis expedita veniam quia. Et qui et autem ut ut. Voluptatibus hic voluptatem voluptas.', '0653d961-e082-4cda-bb03-ba4ffdbfd224', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('edb6f429-a88b-41ee-95cb-1963d5ac04b3', 'Enim modi culpa fuga sunt voluptatem. Expedita odit quos sunt omnis. Est repudiandae corporis eligendi. Aut quas dolor consequatur quisquam sint.', 'bdb65844-fde2-4442-8fee-6361f681f7c7', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('edc92398-6b47-4e2e-b1de-f2f45183cc8b', 'Explicabo sit dicta et doloremque qui sed. Consequatur aliquid aut atque architecto. Quas odit id excepturi eum. Quo quasi vitae eum iste dolorem quia sed.', '634467a5-295c-49df-800f-e66c4929a641', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f4990dd9-15aa-4f8b-ae09-adc984f0a2cb', 'Dolores quia doloremque perferendis ipsa numquam alias aut ratione. Architecto ea et eum laudantium tempora quia aut. Enim nihil nulla aperiam voluptas commodi sapiente.', '71a95e2c-29cd-4176-80c3-ab2b41e96517', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fd7bd79d-f41c-4ed8-89ef-3dc3df1f12e0', 'Veritatis non temporibus vero et dolorem. Autem saepe exercitationem alias deleniti nesciunt architecto doloremque. Ipsum eligendi sint necessitatibus laudantium.', '84945533-e7a0-413e-8db3-c7995860395e', '2024-03-20 11:54:00', '2024-03-20 11:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(85, '0001_01_01_000000_create_users_table', 1),
(86, '0001_01_01_000001_create_cache_table', 1),
(87, '0001_01_01_000002_create_jobs_table', 1),
(88, '2024_03_19_201429_create_sections_table', 1),
(89, '2024_03_19_201455_create_controls_table', 1),
(90, '2024_03_19_201512_create_questions_table', 1),
(91, '2024_03_19_201523_create_information_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` char(36) NOT NULL,
  `text` text NOT NULL,
  `control_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `control_id`, `created_at`, `updated_at`) VALUES
('00c658da-4559-48ef-a343-4ab801657f2d', 'Voluptas aut velit deleniti autem numquam asperiores debitis.', 'cbf8e017-42b4-4b0e-9ed0-1fa8e778b0a8', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0653d961-e082-4cda-bb03-ba4ffdbfd224', 'Quaerat voluptate veniam natus reprehenderit quia.', '7a71190a-318b-4396-8210-fdb7ed2b808d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0f86c9cf-fa87-4463-bc81-8a0acea723f3', 'Et ut officia quis quis.', '89ede5a3-95b3-418c-b4ce-b2146c588cf6', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('13046c73-0edb-4d0d-b143-490191457c8c', 'Non odit et asperiores corrupti pariatur reprehenderit.', '6485936b-0b15-404a-a950-8d0fc69c91c5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('15c507bd-83b4-4c3f-a51c-8b112cb563c0', 'Fuga repellendus aut nobis iusto sed labore suscipit.', '7a71190a-318b-4396-8210-fdb7ed2b808d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2336895a-909f-468d-8655-b7ba09ea9133', 'Cupiditate quia doloremque et mollitia eligendi odit.', '855b6c68-30fe-4587-a475-7b78240efc10', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('23d5391e-758d-4590-b681-8c4cfded4282', 'Omnis eum nulla quas facilis.', '79ded810-6822-487c-8fb8-d8cee037ea3d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2670fe17-8431-4bff-b41e-84ca2814b5cf', 'Quis velit qui excepturi iusto et iste.', 'a247e096-47af-4ea0-afe9-c9294150dfa2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('279074a7-cfb5-4a3b-975a-c41f46f533bb', 'Deserunt sapiente dolorum error aspernatur excepturi dolores.', 'c7c85b16-34e6-4ec5-a06d-eca10237454e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2ee88feb-b69b-4df7-8f5b-4b655b487eb2', 'Perspiciatis rem accusantium sequi aut vel quaerat nisi.', '8079a17d-0897-43a6-8d1b-df1a5f66838b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2f56bda1-9bd2-4062-84ae-5eda39e77beb', 'Vitae libero aut aut praesentium architecto ea sint.', 'a247e096-47af-4ea0-afe9-c9294150dfa2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('335024df-7a19-46cb-8e4f-1c9982d759ed', 'Fugit tempora voluptate dolorem voluptatum odio.', '79ded810-6822-487c-8fb8-d8cee037ea3d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3daa965e-9b30-4ee4-a9bd-f650736c9aca', 'Eveniet sed odio perferendis tempore.', '7fafb089-ba9e-42ed-b959-a226bd5fc841', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('41e819cf-08be-4aa9-9933-45c7589ee785', 'Laborum sit nam optio voluptatem voluptas necessitatibus a.', '7fafb089-ba9e-42ed-b959-a226bd5fc841', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4c042372-3774-42ae-b3ac-2394d2db2e36', 'A omnis ipsam sequi molestiae.', '8ce6dd89-35a9-4bbd-865f-346d6f7e080b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('520a22cb-24d1-4e2c-985e-1dc9ba0bea20', 'Praesentium a nihil sequi aut dolor.', '919cecb5-739d-4866-adb9-8e2f6431b4b4', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5542c51d-2ee0-4e91-8a55-bad07627d446', 'Reprehenderit impedit quidem ut quod ad.', 'd442b626-512d-466e-aa80-9abeeda0456d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5b3beb39-16e1-4ec4-b091-5b0f4391e2ef', 'Dolorum perspiciatis unde earum unde aut eum.', '919cecb5-739d-4866-adb9-8e2f6431b4b4', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5cd7350c-28b8-4fe8-a794-3a18683161cb', 'Beatae quis corrupti pariatur molestias at sed.', 'c385be0e-5148-43e7-9c1f-1fa64a2b0bc3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5e759e8a-a42a-4a23-9c4e-a12d6cf67502', 'Dignissimos doloribus error voluptas voluptas eius facere.', 'f9427b91-8f0b-4eb8-b735-919b7c51710f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('61062e34-ad24-41f1-9a3b-2e7fb1b8bda9', 'Quam molestias accusamus culpa neque.', 'c7c85b16-34e6-4ec5-a06d-eca10237454e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('634467a5-295c-49df-800f-e66c4929a641', 'Asperiores aut odit aut libero sed maiores.', '8079a17d-0897-43a6-8d1b-df1a5f66838b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('63701c4b-3ad0-4132-a56c-25892ea87818', 'Excepturi dolorem voluptatem excepturi distinctio odit nostrum voluptatum.', '9748f2be-f432-48c4-b125-ef25d586df6a', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6a09a15d-de08-4d7a-a401-240d7acf2060', 'Laudantium officiis at quis eius.', '8ce6dd89-35a9-4bbd-865f-346d6f7e080b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6c987f89-43b6-4efe-96f0-9f561000b86c', 'Adipisci nemo dolorum voluptatem omnis aut et.', 'd442b626-512d-466e-aa80-9abeeda0456d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('71a95e2c-29cd-4176-80c3-ab2b41e96517', 'Neque nisi aut ut.', '855b6c68-30fe-4587-a475-7b78240efc10', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('74605414-5ec5-4032-b82a-87f5c28c05ff', 'Repudiandae nemo est voluptatem dolores.', '6485936b-0b15-404a-a950-8d0fc69c91c5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7b21dbfb-40b7-411b-8961-ea72d3fe733b', 'Voluptatum laudantium placeat delectus eos aut aspernatur qui.', 'c385be0e-5148-43e7-9c1f-1fa64a2b0bc3', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('80226c21-c2e3-4773-9176-f8fe21282ea1', 'Aliquam nisi molestiae sint ut nisi.', '8079a17d-0897-43a6-8d1b-df1a5f66838b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('84945533-e7a0-413e-8db3-c7995860395e', 'Ducimus quia eos maxime quas et ut voluptatem.', '7fafb089-ba9e-42ed-b959-a226bd5fc841', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8a9fcd15-eccf-4f3f-b90b-a63b1eafe52b', 'Impedit consequatur aut ut rerum laborum.', '8ce6dd89-35a9-4bbd-865f-346d6f7e080b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8db35ee0-fc7c-4553-b249-c29da79b7388', 'Necessitatibus officiis est temporibus in sit.', '1db03b39-ba94-40a8-a1aa-99851459cdff', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('985931ae-ce9b-4471-bf6a-cf10bfd7f22c', 'Aut quo et id quo velit qui cum.', '1db03b39-ba94-40a8-a1aa-99851459cdff', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9a6e99b7-d03e-4cda-9b55-e7ca1ae386b0', 'Qui et delectus unde qui cumque sint voluptas.', 'a0be2ff6-3e18-4287-99a9-d398022ea552', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a0599632-acc3-488b-80d3-d85c1feb7142', 'Eum fugit veritatis quo dolore.', '79ded810-6822-487c-8fb8-d8cee037ea3d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a1344a0d-6673-4598-bba7-bb451c7161ff', 'Tempora aperiam modi eius sint laborum voluptatem aliquam rerum.', '33fda936-daa3-4c67-8962-9ffd8d9aae31', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a14592db-4791-4e43-a241-8e74a179ff96', 'Deserunt qui quod sit nihil numquam ut.', '0ab70944-e239-4012-b9c7-349d1559f02b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a2293af1-36f8-4d1a-ad3c-bdb7a3b81588', 'In aliquid exercitationem ea eos hic.', '33fda936-daa3-4c67-8962-9ffd8d9aae31', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a6d8fe3f-1aca-49e6-8248-b818b130953c', 'Enim suscipit et quae qui ex voluptatem.', 'a0be2ff6-3e18-4287-99a9-d398022ea552', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a8277131-03a9-4e30-ae21-467a40d26449', 'Rerum animi quidem porro vero beatae.', '9748f2be-f432-48c4-b125-ef25d586df6a', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ab38bf81-8812-4c93-8c24-09bf94b3afff', 'Totam nisi est aliquid cumque.', '1db03b39-ba94-40a8-a1aa-99851459cdff', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('afdcde2a-4481-4dac-b94a-f34a184bacf9', 'Quis sed atque laborum ratione.', '89ede5a3-95b3-418c-b4ce-b2146c588cf6', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b313ba7a-fb53-4bc2-8679-4fc1f8ae5bbc', 'Deserunt earum et libero.', 'f9427b91-8f0b-4eb8-b735-919b7c51710f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b3fdfa6f-8133-440f-90fc-c2829d8291f2', 'Facilis vel asperiores quia voluptates omnis quaerat quo sunt.', '0ab70944-e239-4012-b9c7-349d1559f02b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('bdb65844-fde2-4442-8fee-6361f681f7c7', 'Consequuntur quod ipsa autem ut debitis nobis.', 'f9427b91-8f0b-4eb8-b735-919b7c51710f', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('be0a58ca-66d8-446c-9036-f0728fe68260', 'Eum commodi debitis aspernatur.', '9748f2be-f432-48c4-b125-ef25d586df6a', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('bf07b05d-779e-4a5c-b4b3-33372e5acd38', 'Et dolores atque dicta tempore dolorum qui eaque.', 'a247e096-47af-4ea0-afe9-c9294150dfa2', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c46e97cc-b510-4c90-bbd7-bcb546333d3e', 'Sint rerum est temporibus aut libero sit dolorum.', '89ede5a3-95b3-418c-b4ce-b2146c588cf6', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c6490a40-0a8f-4b97-b490-90d54086ee02', 'In sit vero natus quas sunt consequatur.', 'c7c85b16-34e6-4ec5-a06d-eca10237454e', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ca6e8ede-d09d-4a6e-8faa-f48720bd3685', 'Labore nihil expedita quos in non velit.', 'd442b626-512d-466e-aa80-9abeeda0456d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('debc526b-e4e3-4f64-acd7-955931617a1c', 'Laudantium nisi ducimus enim et.', 'a0be2ff6-3e18-4287-99a9-d398022ea552', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e39cc642-37fc-45d7-94f3-e4d12261d3cb', 'Et suscipit adipisci officia sit quia.', '7a71190a-318b-4396-8210-fdb7ed2b808d', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e3d3d3a6-a328-48bd-8f74-263cbd93aad6', 'Aperiam eius et praesentium.', 'cbf8e017-42b4-4b0e-9ed0-1fa8e778b0a8', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f5219a44-ecf4-4ac8-b0de-fa3eb0190df5', 'Quae enim quo veniam magnam veniam.', '33fda936-daa3-4c67-8962-9ffd8d9aae31', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f7ed2d51-f218-46ef-b5fc-3fcf4dc2fe68', 'Minima porro quaerat enim voluptatem repellat.', 'cbf8e017-42b4-4b0e-9ed0-1fa8e778b0a8', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f97c37b8-8e2d-423c-81bd-d2454af56591', 'Ab dolor nesciunt deleniti ut non.', '0ab70944-e239-4012-b9c7-349d1559f02b', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fa6e2c6a-3477-49ab-b711-012f0ab6ecbc', 'Quasi sed unde quo est.', '855b6c68-30fe-4587-a475-7b78240efc10', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fc9309b2-11f1-4728-93a0-56a7a95e511d', 'Expedita quibusdam voluptas rem sapiente aut libero mollitia.', '919cecb5-739d-4866-adb9-8e2f6431b4b4', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('feaf68bc-5b01-4338-a524-f178c8de7a41', 'Non et odio id est pariatur molestiae omnis.', '6485936b-0b15-404a-a950-8d0fc69c91c5', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fed004a0-f50e-48b0-9ad5-065188202a18', 'Hic odio sint odio sunt omnis.', 'c385be0e-5148-43e7-9c1f-1fa64a2b0bc3', '2024-03-20 11:54:00', '2024-03-20 11:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
('01390883-2692-4282-86d6-bda98d3ed75e', 'omnis', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('03910fde-c11d-4cc0-bc30-f230c0427e30', 'id', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0456bcce-5bf9-4b52-85fe-f7508c5acc5d', 'eos', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0602d690-a6f6-4bfc-85bd-cc17aad1c74a', 'blanditiis', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('07511b90-14c0-460f-8c0f-696aa625b576', 'eveniet', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0b80e74f-9426-47fc-994c-699738312cef', 'commodi', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('0ff4b912-4dc7-4bef-821c-35741b83981f', 'reprehenderit', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('125767d1-2f10-4038-9e07-3b0bfc58a488', 'quod', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('149811c8-7075-4149-b555-058edb901cc2', 'qui', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('15ba1b6b-017d-438e-b234-2d7af45c91b8', 'error', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('1bb1e11f-c5f4-4a48-82ea-21827fa16976', 'id', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('20477578-6821-4ab7-8813-844f68a2efd6', 'reiciendis', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('20af0879-423f-4a3b-b83e-ae79be7f89a1', 'atque', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('2566b938-578f-4a8d-8875-2707c84d39d0', 'aut', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('275f0ac0-6f42-4df7-958c-014d9d414b0d', 'dicta', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('27d7403f-848e-40af-bc3a-e3dd05e3fce5', 'repudiandae', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('28d7bc0e-500f-47ad-94e9-edb2a182e21d', 'sed', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2b3a4495-3c04-4ccb-82c2-d3fe9458c173', 'id', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('2c1f306b-b957-4c1e-8883-617626e566a1', 'iste', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('2f033887-1756-4a8f-bc75-4f3f4fa88400', 'praesentium', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('2fdbdf25-68c8-4496-8a8d-594e8a8439ca', 'nihil', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('309ec157-9c11-45dd-8bac-4467b8c67adf', 'et', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('329e16b5-a1d2-45d3-bfa8-21b1b5c3a685', 'et', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('337c8e41-2144-4918-8c65-b84d1431121b', 'voluptatem', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('36ca12e9-d9df-43aa-8316-f0ee4a734b72', 'temporibus', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('374c5b2a-99e6-4e67-a4f9-7241b9ca23a8', 'sit', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('38ce6142-4223-46cf-aff5-770e450dd94b', 'autem', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3d9b105f-1cb0-4b2d-beae-c4cfd6f60959', 'qui', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('3e117d07-2688-465b-bd65-95c8b76049a5', 'dolorem', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('3f9e6fef-7ceb-4b40-afb4-23c3f3d253e4', 'qui', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4179e292-98d3-4254-af0e-22132f344dc9', 'similique', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('41868328-350b-4308-ab46-d46ad6a99fd2', 'fuga', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4384ed5c-b743-41de-9d94-057639cf7fc0', 'placeat', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('48130e55-dece-441b-867e-ad8dadcc1ec5', 'eius', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('493aff3e-9423-4c33-914c-475a822a9d75', 'dolorum', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4b6427bc-610e-4ecd-9873-0e84dc264dbc', 'officiis', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4bbf6d4d-52ad-4e24-a305-e295bd32ab68', 'et', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4c99a6a3-57d2-4a3e-82e4-a02f95fcb922', 'est', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('4d0cb828-0dcd-4241-b775-4b9103400de6', 'ut', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('4d8d6f69-2cca-41fb-a01a-36a80a5afd68', 'numquam', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('50302c4b-bb1d-49b8-af64-0552fa4777c1', 'qui', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('508812cc-97b9-4492-91fb-894a44948642', 'sed', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('53079f30-e7b2-492c-9b8a-77e3d2b4e926', 'dolores', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('533ea2e2-6122-4421-b548-b0840f07cc07', 'et', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('536cfe3c-e63b-4cf6-8ce8-c64e163a8f7f', 'aliquam', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5496cfa1-94a5-4e5f-a116-6bb4ef8eddd9', 'est', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5715f140-5ce3-4359-8f98-ec9619cb7e94', 'sint', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('580fdd67-34be-43d3-adb2-edbebf66d508', 'vero', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('592208a0-ff45-4704-9f96-29eb3989ce1f', 'quas', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5c756c54-aec4-4c2d-81a9-79fd03ab38b0', 'repellat', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('5f825454-a764-4976-a3c5-ef0a2c8c25d0', 'quia', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6158ab3f-53d2-45bb-850e-135b5f49f1fa', 'perspiciatis', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('62681bcb-68bc-452b-86af-4519d034e374', 'saepe', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6473ef1d-00e3-4951-86e7-ecbd7157dffc', 'saepe', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('660653e8-cb8b-4698-8de0-eb5877d048bd', 'corrupti', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('66f1e4b2-cad0-4b29-bac6-c85fb0baf0d3', 'fugiat', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('67c8fa07-8bdc-46c1-8a0a-a20acd2dc0ce', 'laborum', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('689d5db9-df7d-4391-bbd4-661d89ce84b0', 'accusantium', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('68cf8a60-9c96-45e3-ac06-34acb41c4c9f', 'voluptatem', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6949d2ad-7d71-4da1-8b2f-cfdf5a83b087', 'esse', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6ab49f53-ac26-428c-99ea-03a0413d97a7', 'eum', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('6dfb5c02-b792-435f-bbba-2abb09b88f29', 'dolor', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('73d169de-618e-4ebe-be1e-e4c267a17d11', 'voluptatum', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('73e55006-d317-45ee-a76b-31f707ac5682', 'quis', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('75a5c7c1-71ce-4d10-8b2f-79e096f18e1b', 'dolores', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('75c7a0fa-dae2-4f90-8751-a91007ee1919', 'suscipit', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('77ef714d-5cb4-4265-956b-31e7aa238914', 'dolores', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7a6b3dfa-8f39-4e38-ba32-c398cd22c7e8', 'quos', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('7ab33f6d-b1d9-4c69-a79d-8d3f209414ee', 'fugiat', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('7d94c2b3-97ff-4c0c-9bb4-7912f67d3010', 'sed', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('8234d15a-5cb7-4e44-a16e-a0ec7f34eec1', 'aspernatur', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('82df40d0-42a7-4c10-8770-b3ff239fde00', 'officia', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('8479315d-b5c6-4486-a329-81ead6f836e7', 'ipsa', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('8789fb5d-db6f-49c1-84dd-91f033c59787', 'in', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('87da04fc-d684-47b4-a63a-cd6b94301979', 'molestias', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8bba2610-975e-4ed7-a3b8-422713b0d6bf', 'repudiandae', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('8bfb65b7-9181-46fb-9ec4-75817640caeb', 'fugit', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8ec0d925-88f7-4a51-8ae3-8df2d0e78a14', 'sunt', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('8fcd2825-636b-42a8-97eb-e9184519d80c', 'voluptas', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('90445daf-c5dc-4114-a1a5-e93ccf2fa21e', 'praesentium', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('918002d4-f1b1-41a9-8fe9-2a512303e339', 'ullam', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9660595c-8271-47f2-b880-38418fd8f944', 'adipisci', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('991189fb-a825-4f18-99f0-1835ce415852', 'qui', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9ac5a3d0-5621-4d7a-b8d9-36d7a5dff3ba', 'ut', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('9acc38b9-66ea-4830-ad1c-29375509b945', 'consequatur', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('9f3f4be6-50fc-4c38-ae69-c790d2475be2', 'voluptatem', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('a04295e9-20c2-42bd-90cc-64e3b96e6d5d', 'molestiae', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('a0a94dd2-3516-4e1e-a5dd-a31f01a12fa3', 'architecto', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('a12421d5-f5d2-4e79-9406-482637dd764b', 'at', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('a47fd888-d949-41b1-bfa0-865b2e10f209', 'quasi', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('a92ff4d2-4ff4-4f68-be33-288f62a99b14', 'magnam', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('aa836087-e832-4e1a-bc09-6303c6b64109', 'aspernatur', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('ac10da48-ccb2-4222-b92f-4f8bb09a282e', 'est', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('adeab5f0-f62e-4cb3-a59e-1488b5447950', 'facere', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('af64e66d-5f0d-4b51-8b1f-7c620cb95498', 'vel', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('b1655f37-6290-472a-8203-96e349ac968e', 'et', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b1d4fc6c-9a24-4799-a732-3414d0aa78c9', 'odio', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b3fde131-179d-4bd4-addb-5ddcc01b1b3c', 'possimus', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('b4b6922b-fd20-4322-a251-288fa9f3e100', 'expedita', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('b5a4602e-ff0c-42e8-affc-ae009c46209a', 'vel', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ba103f03-2e22-4f0c-a156-4f0a5cc6c206', 'aliquam', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('bca2836f-ae06-4223-bfa1-95ed4c12f620', 'commodi', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('bd14a978-8dcf-453a-902c-dccd24c0beae', 'quod', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('bd8f3333-1754-4ea3-bb6d-77ac4cef87c3', 'et', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('be6423c5-1040-45b4-8f5c-9ffdd44d2538', 'quia', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('be7c3aca-4334-464b-9d20-b3ef2ceb779e', 'est', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c0321e17-7dd7-4ac4-9131-763cc8a8bad2', 'eum', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c410f781-b79b-4fad-84e5-6b72a1534e8d', 'neque', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c48197d1-ae5e-4776-8a78-863d20690288', 'sunt', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('c66c10ca-9087-4092-86b8-70ae56d540e7', 'ipsam', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('c878926a-5ce3-4fdf-ac20-a8172e3ef4dc', 'distinctio', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('ca0f45a7-0bc6-40fc-9667-5a3a996fdef1', 'voluptas', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ca2ca378-2bfc-462c-b2bc-169d15bbfaa9', 'enim', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ce512923-0427-40f3-af51-6128acc07800', 'ut', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d00e76d5-6834-4a40-bce4-3afbd898a6df', 'voluptas', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d1445b2f-9883-41e9-875e-b0bf243a89f7', 'qui', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d26fadb1-b537-4fdd-bfb6-52fa57215b3f', 'voluptatem', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('d2cfeb6b-b085-4881-b466-9b1acc20c6f9', 'est', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('d371daec-1056-4a14-908d-38b8ccd1d9c8', 'officia', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e25c4486-a0d2-445d-963d-571d9f2af5fe', 'debitis', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e2961d94-e7de-4dba-938a-1fb70ac7cb16', 'doloribus', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e40d2596-ba5c-4a79-8b18-f9dc5b9236fd', 'sed', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('e4aa4b6a-e612-4dc7-90d2-d2fdab9e3770', 'ut', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('e6985329-29f9-4aef-a0ff-7eacc6cbe89c', 'sit', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('e71551aa-3223-4d1e-8796-fc95eb3b0c55', 'veritatis', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e7f8bc08-d5a1-4d5d-b830-31f0b3418a49', 'sint', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e80bed5d-9819-4b66-9ae0-c9d03fe1b1fa', 'doloremque', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e9a41ab0-fbad-4a3e-93c5-6e0b55f5b884', 'ratione', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('eab0bbce-ecf1-4b6b-a242-24e198907eb6', 'consequatur', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('eac936ab-275c-405e-a57c-5655b84592a4', 'culpa', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ebd73065-675c-417b-b04a-6e21390b6b10', 'expedita', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('ed5eb6a6-e76f-472e-aab2-87645a803e2f', 'nihil', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('eefcd470-7cc9-48ab-9aea-4167d52dbf64', 'quae', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('efba6133-4883-48ec-8cfb-2faf3f6f8d5d', 'expedita', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('f2861dab-76c0-4aa4-8704-98d987d0e456', 'aut', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('f40ba54d-3f1d-4bf2-9706-3b935659aacd', 'perferendis', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
('f7d098bf-7a68-4796-b706-9e83af61bd3f', 'repellat', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('f7ec3cf0-7ee4-4511-a925-09b4642568d3', 'rerum', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fd013310-afb6-4572-9a94-d607c7572e3a', 'nihil', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('fd280509-f56d-4554-8b09-ddf8f05f4bcb', 'accusamus', '2024-03-20 11:54:00', '2024-03-20 11:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-03-20 11:53:59', '$2y$12$D5unWVOyy.8NAbm8lPy8c./i8XtCSYlsOuYdBZwwBw3hIsrxwIrj2', 'EE39TngIF3', '2024-03-20 11:53:59', '2024-03-20 11:53:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `controls`
--
ALTER TABLE `controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `controls_section_id_index` (`section_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `information_question_id_index` (`question_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_control_id_index` (`control_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `controls`
--
ALTER TABLE `controls`
  ADD CONSTRAINT `controls_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_control_id_foreign` FOREIGN KEY (`control_id`) REFERENCES `controls` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
