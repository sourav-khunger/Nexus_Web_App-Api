-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2021 at 06:17 PM
-- Server version: 5.7.35
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doozyco1_nexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_area`
--

CREATE TABLE `activity_area` (
  `activity_id` int(100) NOT NULL,
  `activity_name_english` text NOT NULL,
  `activity_name_japanese` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_area`
--

INSERT INTO `activity_area` (`activity_id`, `activity_name_english`, `activity_name_japanese`) VALUES
(1, 'hokkaido', '北海道'),
(2, 'aomori', '青森県'),
(3, 'iwate', '岩手県'),
(4, 'miyagi', '宮城県'),
(5, 'akita', '秋田県'),
(6, 'yamagata', '山形県'),
(7, 'fukushima', '福島県'),
(8, 'ibaraki', '茨城県'),
(9, 'tochigi', '栃木県'),
(10, 'gunma', '群馬県'),
(11, 'saitama', '埼玉県'),
(12, 'chiba', '千葉県'),
(13, 'tokyo', '東京都'),
(14, 'kanagawa', '神奈川県'),
(15, 'niigata', '新潟県'),
(16, 'toyama', '富山県'),
(17, 'ishikawa', '石川県'),
(18, 'fukui', '福井県'),
(19, 'yamanashi', '山梨県'),
(20, 'nagano', '長野県'),
(21, 'gifu', '岐阜県'),
(22, 'shizuoka', '静岡県'),
(23, 'aichi', '愛知県'),
(24, 'mie', '三重県'),
(25, 'shiga', '滋賀県'),
(26, 'kyoto', '京都府'),
(27, 'osaka', '大阪府'),
(28, 'hyogo', '兵庫県'),
(29, 'nara', '奈良県'),
(30, 'wakayama', '和歌山県'),
(31, 'tottori', '鳥取県'),
(32, 'shimane', '島根県'),
(33, 'okayama', '岡山県'),
(34, 'hiroshima', '広島県'),
(35, 'yamaguchi', '山口県'),
(36, 'tokushima', '徳島県'),
(37, 'kagawa', '香川県'),
(38, 'ehime', '愛媛県'),
(39, 'kochi', '高知県'),
(40, 'fukuoka', '福岡県'),
(41, 'saga', '佐賀県'),
(42, 'nagasaki', '長崎県'),
(43, 'kumamoto', '熊本県'),
(44, 'oita', '大分県'),
(45, 'miyazaki', '宮崎県'),
(46, 'kagoshima', '鹿児島県'),
(47, 'okinawa', '沖縄県');

-- --------------------------------------------------------

--
-- Table structure for table `buisness_funding`
--

CREATE TABLE `buisness_funding` (
  `funding_id` int(100) NOT NULL,
  `funding_name_english` varchar(225) NOT NULL,
  `funding_name_japanese` varchar(225) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buisness_funding`
--

INSERT INTO `buisness_funding` (`funding_id`, `funding_name_english`, `funding_name_japanese`) VALUES
(1, 'Venture Capital ', 'ベンチャーキャピタル'),
(2, 'Angel', '天使'),
(3, 'Other', 'その他');

-- --------------------------------------------------------

--
-- Table structure for table `buisness_status`
--

CREATE TABLE `buisness_status` (
  `status_id` int(100) NOT NULL,
  `status_name_english` varchar(225) NOT NULL,
  `status_name_japanese` varchar(225) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buisness_status`
--

INSERT INTO `buisness_status` (`status_id`, `status_name_english`, `status_name_japanese`) VALUES
(1, 'Planning Stage', '計画段階'),
(2, 'Preparation Stage', '準備段階'),
(3, 'Launched', '発売');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(100) NOT NULL,
  `created_by` int(100) NOT NULL,
  `joined_user` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `created_by`, `joined_user`) VALUES
(1150, 11, 50);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(100) NOT NULL,
  `device_id` varchar(225) NOT NULL,
  `user_id` int(100) NOT NULL,
  `push_token` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_id`, `user_id`, `push_token`) VALUES
(16, 'FAFE5EF5-4F63-4A4C-A897-B13E322959BA', 50, 'fIC9x9K7qEBBp6CGVdQtC_:APA91bFRMOcRR3Abmq2zuYn_UFI5ZwiFLJPFKmu0B6FDFwnLeMLwK16OfesgICYKPNr1Q2liJ9uJ9lWKCoqJBdfazNRgWdLEHxbcg4eERHenJtWGk4sj7nEV6aIB3bSLIPOs4URvLKjZ'),
(17, '59fa5c701ec3ba8d', 11, 'fcmoTgfYRnasWePNtgKqE3:APA91bF0PcnbRoZlZKxc3E4Ova7nFGrv8Uk_tJVouEEsSMsk3yvOxQ8_QlCL75wfRLCbNFeV3SBYuR9nBnK9qoZhakv72P3mwuPqqsxGNSZbKapYh8GZb7liwayupxPyk8F1abEoqpUd');

-- --------------------------------------------------------

--
-- Table structure for table `hidden_users`
--

CREATE TABLE `hidden_users` (
  `hidden_id` int(100) NOT NULL,
  `hidden_by` int(100) NOT NULL,
  `hidden_user` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `industry_id` int(100) NOT NULL,
  `industry_parent_id` int(100) DEFAULT '0',
  `industry_name_english` text NOT NULL,
  `industry_name_japanese` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`industry_id`, `industry_parent_id`, `industry_name_english`, `industry_name_japanese`) VALUES
(1, 0, 'Food / Agriculture', '食品・農業'),
(3, 1, 'Food Production', '食品生産'),
(4, 1, 'Processed Foods', '食品加工'),
(5, 1, 'FoodTech', 'フードテック'),
(6, 1, 'Drinks / Alcohol', '飲料・酒類'),
(7, 1, 'Fisheries', '漁業・水産'),
(8, 1, 'Agriculture', '農業'),
(9, 1, 'Agriculture', '農業'),
(10, 1, 'Livestock', '畜産業'),
(11, 1, 'Plant Processing / Fertility', '植物加工・生育'),
(12, 1, 'AgriTech', 'アグリテック'),
(13, 1, 'Other', 'その他'),
(14, 0, 'Medical / Health', '医療・健康'),
(16, 14, 'Healthcare', 'ヘルスケア'),
(17, 14, 'Care Work', '介護'),
(18, 14, 'Telemedicine', '遠隔医療'),
(19, 14, 'Healthcare Workers', '医療従事者向けサービス'),
(20, 14, 'Medical Equipment', '医療機器'),
(21, 14, 'Drug', '医薬品'),
(22, 14, 'Hospital', '病院'),
(23, 14, 'Mental Health', 'メンタルヘルス'),
(24, 14, 'Clinical Diagnosis / examination', '臨床診断・検査'),
(25, 14, 'Preventive Medicine', '予防医療'),
(26, 14, 'Other', 'その他'),
(27, 0, 'Daily Essentials / Service', '生活用品・サービス'),
(29, 27, 'Childcare', '子育て・保育'),
(30, 27, 'Senior', 'シニア'),
(31, 27, 'Caregiving', '介護'),
(32, 27, 'Wedding', 'ウェディング'),
(33, 27, 'Funeral', '葬儀'),
(34, 27, 'Sharing Economy', 'シェアリングエコノミー'),
(35, 27, 'Security / Guard', 'セキュリティ・警備'),
(36, 27, 'Beauty', '美容'),
(37, 27, 'Pet', 'ペット'),
(38, 27, 'Packaging Materials', '包装資材'),
(39, 27, 'Marriage Support', '結婚支援'),
(40, 27, 'other', 'その他'),
(41, 0, 'Education', '教育'),
(43, 41, 'EdTech', 'エドテック'),
(44, 41, 'Education Service', '教育サービス'),
(45, 41, 'Training Service', '研修サービス'),
(46, 41, 'Intellectual Education', '知育'),
(47, 41, 'Other', 'その他'),
(48, 0, 'Finance', '金融'),
(50, 48, 'Bank', '銀行'),
(51, 48, 'Credit Union', '信用金庫'),
(52, 48, 'Securities', '証券'),
(53, 48, 'Credit', 'クレジット・信販'),
(54, 48, 'Investment', '投資'),
(55, 48, 'Lease', 'リース'),
(56, 48, 'Consumer Finance', '消費者金融'),
(57, 48, 'Life Insurance', '生保'),
(58, 48, 'Non-life Insurance', '損保'),
(59, 48, 'Fintech', 'フィンテック'),
(60, 48, 'Crypto Currency', '仮想通貨'),
(61, 48, 'Blockchain', 'ブロックチェーン'),
(62, 48, 'Crowdfunding', 'クラウドファンディング'),
(63, 48, 'InsurTech', 'インシュアテック'),
(64, 48, 'Payment', '決済'),
(65, 48, 'Inheritance', '相続'),
(66, 48, 'Other', 'その他'),
(67, 0, 'Construction', '建設'),
(68, 67, '	\r\nSelect All', 'すべて選択'),
(69, 67, 'General Contractor', 'ゼネコン'),
(70, 67, 'Civil Engineering', '土木・特殊土木'),
(71, 67, 'Construction Design', '建設設計'),
(72, 67, 'Road Construction', '道路工事'),
(73, 67, 'i-Construction(ICT Civil Engineering)', 'i-Construction(ICT土木)'),
(74, 67, 'Architectural Design', '意匠設計'),
(75, 67, 'Other', 'その他'),
(76, 0, 'Real Estate', '不動産'),
(78, 76, 'Developer', 'ディベロッパー'),
(79, 76, 'Housing', '住宅'),
(80, 76, 'Real Estate Leasing / Brokerage', '不動産賃貸・仲介'),
(81, 76, 'Condominium Management', 'マンション管理'),
(82, 76, 'Housing Equipment / Interior', '住宅設備・インテリア'),
(83, 76, 'Remodeling / Enovation', 'リフォーム・リノベーション'),
(84, 76, 'Land Utilization', '土地活用'),
(85, 76, 'Coworking Share Office', 'コワーキング・シェアオフィス'),
(86, 76, 'Other', 'その他'),
(87, 0, 'Advertising / Media', '広告・メディア'),
(89, 87, 'AdTech', 'AdTech'),
(90, 87, 'E-commerce', 'Eコマース'),
(91, 87, 'Broadcast', '放送'),
(92, 87, 'Newspaper', '新聞'),
(93, 87, 'Publishing', '出版'),
(94, 87, 'Printing', '印刷'),
(95, 87, 'Internet Advertising', 'インターネット広告'),
(96, 87, 'Portal / Search', 'ポータル・検索'),
(97, 87, 'SNS', 'SNS'),
(98, 87, 'Internet Media / App', 'インターネットメディア・アプリ'),
(99, 87, 'Design', 'デザイン'),
(100, 87, 'Video Production', '動画制作'),
(101, 87, 'Production', '制作'),
(102, 87, 'Advertising Agency', '広告代理店'),
(103, 87, 'Local Newspaper / Local Media', '地方紙・ローカルメディア'),
(104, 87, 'Promotion', 'プロモーション'),
(105, 87, 'SEO', 'SEO'),
(106, 87, 'Other', 'その他'),
(107, 0, 'Leisure / Entertainment / Travel / Inbound', 'レジャー・娯楽・旅行・インバウンド'),
(108, 106, 'All Select', 'すべて選択'),
(109, 107, 'Game', 'ゲーム'),
(110, 107, 'Sport / Fitness', 'スポーツ・フィットネス'),
(111, 107, 'Entertainment', '芸能'),
(112, 107, 'Event', 'イベント'),
(113, 107, 'Music', '音楽'),
(114, 107, 'Movies / Videos', '映画・映像'),
(115, 107, 'Leisure / Theme Park / Hotel', 'レジャー・テーマパーク・ホテル'),
(116, 107, 'Travel', '旅行'),
(117, 107, 'Translation', '翻訳'),
(118, 107, 'Inbound', 'インバウンド'),
(119, 107, 'Tourism', '観光'),
(120, 107, 'Traditional Crafts', '伝統工芸'),
(121, 107, 'Outdoors', 'アウトドア'),
(122, 107, 'esports', 'eスポーツ'),
(123, 107, 'VTuber', 'VTuber'),
(124, 107, 'Youtuber', 'Youtuber'),
(125, 107, 'Other', 'その他'),
(126, 0, 'Distribution / Eating Out', '流通・外食'),
(127, 126, 'All Select', 'すべて選択'),
(128, 126, 'Trading Company', '商社'),
(129, 126, 'Apparel fashion', 'アパレル・ファッション'),
(130, 126, 'Retail', '小売'),
(131, 126, 'Eating Out', '外食'),
(132, 126, 'Other', 'その他'),
(133, 0, 'Transportation / Logistics', '運送・物流'),
(134, 133, 'All Select', 'すべて選択'),
(135, 133, 'Transportation', '運送・輸送'),
(136, 133, 'Transportation infrastructure', '交通インフラ'),
(137, 133, 'Logistics / Warehouse', '物流・倉庫'),
(138, 133, 'Drone', 'ドローン'),
(139, 133, 'Mobility', 'モビリティ'),
(140, 133, 'Other', 'その他'),
(141, NULL, 'HR / Outsource', 'HR/アウトソース'),
(142, 141, 'All Select', 'すべて選択'),
(143, 141, 'Temporary Staffing', '人材派遣'),
(144, 141, 'Recruitment Support', '採用支援'),
(145, 141, 'Crowdsourcing', 'クラウドソーシング'),
(146, 141, 'Talent Management', 'タレントマネージメント'),
(147, 141, 'HRtech', 'HRtech'),
(148, 141, 'Outsourcing', 'アウトソーシング'),
(149, 141, 'Call Center', 'コールセンター'),
(150, 141, 'SES', 'SES'),
(151, 141, 'RPA', 'RPA'),
(152, 141, 'Other', 'その他'),
(153, NULL, 'IT / Data', 'IT/通信'),
(155, 153, 'Data Infrastructure / Line', '通信インフラ・回線'),
(156, 153, 'Software / System development', 'ソフトウェア・システム開発'),
(157, 153, 'IT Service', 'ITサービス'),
(158, 153, 'SaaS', 'SaaS'),
(159, 153, 'Big Data', 'ビッグデータ'),
(160, 153, 'Data Mining', 'データマイニング'),
(161, 153, 'Cloud Service', 'クラウドサービス'),
(162, 153, 'App Development', 'アプリ開発'),
(163, 153, 'Other', 'その他'),
(164, 0, 'Research / Consulting', 'リサーチ・コンサルティング'),
(165, 164, 'All Select', 'すべて選択'),
(166, 164, 'Consulting', 'コンサルティング'),
(167, 164, 'Audit Corporation', '監査法人'),
(168, 164, 'Professional', '土業'),
(169, 164, 'Research', 'リサーチ'),
(170, 164, 'Intellectual Property', '知的財産'),
(171, 164, 'Other', 'その他'),
(172, 0, 'Resources / Energy / Materials', '資源・エネルギー・素材'),
(174, 172, 'Power Plant / Electricity / Gas', '発電所・電力・ガス'),
(175, 172, 'Energy / Resources', 'エネルギー・資源'),
(176, 172, 'Hydrogen Energy', '水素エネルギー'),
(177, 172, 'Renewable Energy', '再生可能エネルギー'),
(178, 172, 'Non-ferrous Metal', '非鉄金属'),
(179, 172, 'Steal', '鉄鋼'),
(180, 172, 'Chemical', '化学'),
(181, 172, 'Paper / Pulp', '紙・パルプ'),
(182, 172, 'Glass', 'ガラス'),
(183, 172, 'Fiber', '繊維'),
(184, 172, 'Renewable Resources', '再生資源'),
(185, 172, 'Recycling', 'リサイクル'),
(186, 172, 'Other', 'その他'),
(187, 0, 'Automobiles / Machines', '自動車・機械'),
(188, 187, 'All Select', 'すべて選択'),
(189, 187, 'Automaker', '自動車メーカー'),
(190, 187, 'Auto Parts / Car Supplies', '自動車部品・カー用品'),
(191, 187, 'Used Cars', '中古車'),
(192, 187, 'Aircraft Industry, Railroad Vehicles, Shipbuilding', '航空機産業・鉄道車両・造船'),
(193, 187, 'Construction / Working Machinery', '建設・工作機械'),
(194, 187, 'Plant Engineering / General Heavy Equipment', 'プラントエンジニアリング・総合重機'),
(195, 187, 'Next Generation Automobiles', '次世代自動車'),
(196, 187, 'Other', 'その他'),
(197, 0, 'Electronics', 'エレクトロニクス'),
(198, 197, 'All Select', 'すべて選択'),
(199, 197, 'Home Appliances', '家電'),
(200, 197, 'Copier / Printer', '複写機・プリンタ'),
(201, 197, 'Battery', '電池'),
(202, 197, 'Semiconductor', '半導体'),
(203, 197, 'Electronic Components', '電子部品'),
(204, 197, 'Robot', 'ロボット'),
(205, 197, 'Kitchen Products', 'キッチン製品'),
(206, 197, 'Air Environment Products', '空気環境製品'),
(207, 197, 'Other', 'その他'),
(208, 0, 'Trading Company / Specialized Trading Company', '商社・専門商社'),
(210, 208, 'Specialized Trading Company', '専門商社'),
(211, 208, 'Trading Company', '総合商社'),
(212, 208, 'Other', 'その他'),
(213, 0, 'Marketing', 'マーケティング'),
(215, 213, 'Marketing', 'マーケティング'),
(216, 213, 'Web Marketing', 'Webマーケティング'),
(217, 213, 'Digital Marketing', 'デジタルマーケティング'),
(218, 213, 'Other', 'その他'),
(219, NULL, 'Retail', '小売'),
(221, 219, 'Cosmetics', '化粧品'),
(222, 219, 'Stationery', '文具'),
(223, 219, 'Furniture / Interior', '家具・インテリア'),
(224, 219, 'Handmade', 'ハンドメイド'),
(225, 219, 'Trade', '貿易'),
(226, 219, 'Wholesale', '卸売'),
(227, 219, 'Other', 'その他'),
(228, 0, 'Security / Cleaning', '警備・清掃'),
(230, 228, 'Drain', '排水'),
(231, 228, 'Security', '警備'),
(232, 228, 'Cleaning', '清掃'),
(233, 228, 'Other', 'その他'),
(234, 0, 'Security', 'セキュリティ'),
(236, 234, 'e-KYC', 'e-KYC'),
(237, 234, 'Security', 'セキュリティ'),
(238, 234, 'Other', 'その他');

-- --------------------------------------------------------

--
-- Table structure for table `Investment`
--

CREATE TABLE `Investment` (
  `investment_id` int(100) NOT NULL,
  `investment_name_english` varchar(225) NOT NULL,
  `investment_name_japanese` varchar(225) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Investment`
--

INSERT INTO `Investment` (`investment_id`, `investment_name_english`, `investment_name_japanese`) VALUES
(1, 'Venture capital', 'ベンチャーキャピタル'),
(2, 'angel', '天使'),
(3, 'other', 'その他 ');

-- --------------------------------------------------------

--
-- Table structure for table `purpose_category`
--

CREATE TABLE `purpose_category` (
  `purpose_id` int(100) NOT NULL,
  `purpose_name_english` text NOT NULL,
  `purpose_name_japanese` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purpose_category`
--

INSERT INTO `purpose_category` (`purpose_id`, `purpose_name_english`, `purpose_name_japanese`) VALUES
(1, 'Startup a business(for individuals)', '起業（個人向け）'),
(2, 'Startup a company with someone', '誰かと一緒に会社を立ち上げる'),
(3, 'Expand company business', '会社の事業を拡大する'),
(4, 'Help company', 'ヘルプ会社'),
(5, 'Help individuals', '個人を助ける'),
(6, 'Invest someone', '誰かを投資する');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(100) NOT NULL,
  `skill_parent_id` int(100) NOT NULL DEFAULT '0',
  `skill_name_english` text NOT NULL,
  `skill_name_japanese` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_parent_id`, `skill_name_english`, `skill_name_japanese`) VALUES
(1, 0, 'Business Management', '経営'),
(2, 1, 'Starting my business', '起業準備中'),
(3, 1, 'Entrepreneur', '起業家'),
(4, 1, 'Start-up Owner', 'スタートアップ経営者'),
(5, 1, 'Venture Owner', 'ベンチャー経営者'),
(6, 1, 'Small Business Owner', '中小企業の経営者'),
(7, 1, 'Investment', '投資'),
(8, 0, 'Consulting', 'コンサル'),
(9, 8, 'Management / Strategy Consultant', '経営・戦略コンサルタント'),
(10, 8, 'IT consultant', 'ITコンサルタント'),
(11, 8, 'Human Resources Consultant', 'HRコンサルタント'),
(12, 8, 'Web Consultant', 'Webコンサルタント'),
(13, 0, 'Engineering', 'エンジニア'),
(14, 13, 'Development Design / Strategy', '開発設計・戦略'),
(15, 13, 'Product Manager (PM)', 'プロダクトマネージャー（PM）'),
(16, 13, 'System Engineer (SE)', 'システムエンジニア（SE）'),
(17, 13, 'Create a Website', 'Webサイト制作'),
(18, 13, 'Create a Web App', 'Webアプリ開発'),
(19, 13, 'Create a Smartphone App', 'スマホアプリ開発'),
(20, 19, 'iOS App', 'iOSアプリ開発'),
(21, 19, 'Android App', 'Androidアプリ開発'),
(22, 13, 'New Tech Development', '最新の開発技術'),
(23, 22, '-AI / Machine Learning / Deep Learning', 'AI・機械学習・ディープラーニング'),
(24, 22, 'Blockchain', 'ブロックチェーン'),
(25, 22, 'IoT / Hardware / Robotics', 'IoT・ハードウェア・ロボティクス'),
(26, 22, 'AR・VR・MR', 'AR・VR・MR'),
(27, 22, 'IoT Engineer', 'IoTエンジニア'),
(28, 13, 'Infrastructure', 'インフラ'),
(29, 28, 'Database engineer', 'データベースエンジニア'),
(30, 28, 'Server Engineer', 'サーバーエンジニア'),
(31, 28, 'Security Engineer', 'セキュリティエンジニア'),
(32, 28, 'Network Engineer', 'ネットワークエンジニア'),
(33, 13, 'Maintenance/Operation', '保守・運用'),
(34, 33, 'Testing / Quality Control', 'テスト・品質管理'),
(35, 33, 'System Management / Operation', 'システム管理・運用'),
(36, 33, 'Technical Support', 'テクニカルサポート'),
(37, 33, 'Control / Embedded Engineer', '制御・組み込みエンジニア'),
(38, 33, 'Mechanical / Electrical Engineer', '機械・電気エンジニア'),
(39, 33, 'Electronic/Semiconductor Engineer', '電子・半導体エンジニア'),
(40, 33, 'Material / Chemical Engineer', '素材・化学エンジニア'),
(41, 33, 'Architecture / Civil Engineering Engineer', '建築・土木エンジニア'),
(42, 33, 'Quality / Production Control', '品質・生産管理'),
(43, 33, 'Sales Engineer', 'セールスエンジニア'),
(44, 0, 'Designer', 'デザイナー'),
(45, 44, 'Digital design', 'デジタルデザイン'),
(46, 45, 'Web designer', 'Webデザイナー'),
(47, 45, 'UI / UX Designer', 'UI・UXデザイナー'),
(48, 45, 'CG designer', 'CGデザイナー'),
(49, 44, 'Graphic designer', 'グラフィックデザイナー'),
(50, 49, 'Graphic designer', 'グラフィックデザイナー'),
(51, 49, 'Illustrator', 'イラストレーター'),
(52, 49, 'art director', 'アートディレクター'),
(53, 49, 'DTP designer', 'DTPデザイナー'),
(54, 49, 'DTP operator', 'DTPオペレーター'),
(55, 49, 'Package designer', 'パッケージデザイナー'),
(56, 49, 'Character designer', 'キャラクターデザイナー'),
(57, 44, 'Product design', 'プロダクトデザイン'),
(58, 57, 'Product designer', 'プロダクトデザイナー'),
(59, 57, 'Industrial designer', 'インダストリアルデザイナー'),
(60, 57, 'Interior designer', 'インテリアデザイナー'),
(61, 57, 'Car designer', 'カーデザイナー'),
(62, 57, 'Miscellaneous goods designer', '雑貨デザイナー'),
(63, 57, 'Jewelry designer', 'ジュエリーデザイナー'),
(64, 57, 'Prototype master', '原型師'),
(65, 44, 'Display design', 'ディスプレイデザイン'),
(66, 65, 'Spatial designer', '空間デザイナー'),
(67, 65, 'Display designer', 'ディスプレイデザイナー'),
(68, 65, 'Lighting designer', '照明デザイナー'),
(69, 0, 'Marketing', 'マーケティング'),
(70, 69, 'WEB Marketer', 'マーケター'),
(71, 69, 'WEB Director', 'ディレクター'),
(72, 69, 'Casting Director', 'キャスティングディレクター'),
(73, 69, 'Web Advertising / operations', '広告施策・運用'),
(74, 69, 'Web Analyst', 'アナリスト'),
(75, 69, 'Game Planner', 'ゲームプランナー'),
(76, 69, 'MD Merchandiser', 'MD・マーチャンダイザー'),
(77, 69, 'Marketing Researcher', 'マーケティングリサーチャー'),
(78, 69, 'Marketing Planner', 'マーケティングプランナ'),
(79, 0, 'Creative', 'クリエイティブ'),
(80, 79, 'Video / Movie Editor', '動画・映像編集者'),
(81, 79, 'Video / Movie Cameraman', '動画・映像カメラマン'),
(82, 79, 'CM Planner', 'CMプランナー'),
(83, 79, 'Youtube Planner', 'Youtubeプランナー'),
(84, 79, 'Photographer / Cameraman', '写真家・カメラマン'),
(85, 79, 'Cartoonist / Picture Book Author', '漫画家・絵本作家'),
(86, 79, 'Musician / Composer / Songwriter', '音楽家・作曲家・作詞家'),
(87, 79, 'Screenplay / Screenwriter', '脚本/シナリオ作成'),
(88, 79, 'Interior Coordinator', 'インテリアコーディネーター'),
(89, 79, 'Color coordinator', 'カラーコーディネーター'),
(90, 0, 'Sales', 'セールス'),
(91, 90, 'toB sales', 'toBセールス'),
(92, 90, 'toC sales', 'toCセールス'),
(93, 90, 'Enterprise sales', 'エンタープライズセールス'),
(94, 0, 'Writer', 'ライター'),
(95, 94, 'Writer / Editor', 'ライター・編集'),
(96, 94, 'Sales Writer', 'セールスライター'),
(97, 94, 'Video Writer', '動画ライター'),
(98, 94, 'Translator', '翻訳者'),
(99, 0, 'Influencer', 'インフルエンサー'),
(100, 99, 'Youtube', 'Youtube'),
(101, 99, 'TikTok', 'TikTok'),
(102, 99, 'Blog', 'ブログ'),
(103, 99, 'Twitter', 'Twitter'),
(104, 99, 'Podcast', 'Podcast'),
(105, 99, 'SNS Measure / Manage', 'SNS施策・運用'),
(106, 0, 'Customer Management', 'カスタマー系'),
(107, 106, 'Customer Success', 'カスタマーサクセス'),
(108, 106, 'Community Manager', 'コミュニティマネージャ'),
(109, 106, 'Customer Support', 'カスタマーサポート'),
(110, 0, 'Back Office System', 'バックオフィス'),
(111, 110, 'Human Resources', '人事'),
(112, 110, 'Finance', '経理・財務'),
(113, 110, 'Legal', '法務'),
(114, 110, 'General Affairs', '総務\r\n'),
(115, 110, 'Public Relations', 'PR・広報'),
(116, 110, 'Office Work', '事務'),
(117, 110, 'Secretary', '秘書'),
(118, 0, 'Professional', '土業'),
(119, 118, 'Lawyer', '弁護士'),
(120, 118, 'Public Notary', '行政書士'),
(121, 118, 'Judicial Scrivener', '司法書士'),
(122, 118, 'Labor and Social Security Attorney', '社会保険労務士'),
(123, 118, 'Tax Accountant', '税理士'),
(124, 118, 'Management Consultant', '中小企業診断士'),
(125, 118, 'Land and House Investigator', '土地家屋調査士'),
(126, 118, 'Certified Public Accountant', '公認会計士'),
(127, 118, 'US Certified Public Accountant', '米国公認会計士'),
(128, 0, 'Finance', '金融'),
(129, 128, 'Financial profession', '金融専門職系'),
(130, 129, 'Certified accountant', '公認会計士'),
(131, 129, 'Tax accountant', '税理士'),
(132, 129, 'banker', '銀行員'),
(133, 129, 'Financial planner', 'ファイナンシャルプランナー'),
(134, 129, 'Foreign finance', '外資系金融'),
(135, 128, 'Stocks / securities', '株・証券系'),
(136, 135, 'Fund manager', 'ファンドマネージャー'),
(137, 135, 'trader', 'トレーダー'),
(138, 135, 'Analyst', 'アナリスト'),
(139, 135, 'economist', 'エコノミスト'),
(140, 135, 'Securities company', '証券会社'),
(141, 135, 'Day trader', 'デイトレーダー'),
(142, 128, 'Insurance system', '保険系'),
(143, 142, 'Insurance agent', '保険外交員'),
(144, 142, 'Actuary', 'アクチュアリー'),
(145, 142, 'Technology adjuster', '技術アジャスター'),
(146, 142, 'Non-life insurance company', '損害保険会社'),
(147, 142, 'Life insurance company', '生命保険会社'),
(148, 0, 'Architecture / real estate', '建築・不動産'),
(149, 148, 'real estate', '不動産'),
(150, 149, 'Real estate appraiser', '不動産鑑定士'),
(151, 149, 'Land and house inspector', '土地家屋調査士'),
(152, 149, 'Residential land and building transaction chief', '宅地建物取引主任者'),
(153, 149, 'Apartment manager', 'マンション管理士'),
(154, 149, 'Condominium manager', 'マンション管理人'),
(155, 149, 'Building maintenance', 'ビルメンテナンス'),
(156, 149, 'Real estate business', '不動産営業'),
(157, 149, 'Real estate consultant', '不動産コンサルタント'),
(158, 149, 'Real estate developer', '不動産デベロッパー'),
(159, 149, 'Facility manager', 'ファシリティマネージャー'),
(160, 149, 'Condominium management', 'マンション管理'),
(161, 148, 'Construction work', '建築作業'),
(162, 161, 'Architect', '建築士'),
(163, 161, 'carpenter', '大工'),
(164, 161, 'Miya carpenter', '宮大工'),
(165, 161, 'Tobi craftsman', '鳶職人'),
(166, 161, 'Plasterer', '左官'),
(167, 161, 'Electrical worker', '電気工事士'),
(168, 161, 'Civil engineering worker', '土木作業員'),
(169, 161, 'Heavy equipment operator', '重機オペレーター'),
(170, 161, 'Painter', '塗装工'),
(171, 161, 'Welder', '溶接工'),
(172, 161, 'Plumber', '配管工'),
(173, 161, 'Architectural sheet metal work', '建築板金工'),
(174, 161, 'Diver', '潜水士'),
(175, 148, 'Construction company / consulting', '建築企業・コンサル'),
(176, 175, 'Construction company employee', '建設会社社員'),
(177, 175, 'Home maker', '住宅メーカー'),
(178, 175, 'Housing equipment manufacturer', '住宅設備メーカー'),
(179, 175, 'Construction consultant', '建設コンサルタント'),
(180, 175, 'Environmental consultant', '環境コンサルタント'),
(181, 175, 'Environmental measurer', '環境計量士'),
(182, 175, 'Surveyor', '測量士'),
(183, 175, 'Biotope manager', 'ビオトープ管理士'),
(184, 148, 'Construction management', '施工管理'),
(185, 184, 'Building construction management engineer', '建築施工管理技士'),
(186, 184, 'Civil engineering construction management engineer', '土木施工管理技士'),
(187, 184, 'Electrical work construction management engineer', '電気工事施工管理技士'),
(188, 184, 'Pipe construction management engineer', '管工事施工管理技士'),
(189, 184, 'Construction machinery construction engineer', '建設機械施工技士'),
(190, 184, 'Landscaping construction management engineer', '造園施工管理技士'),
(191, 0, 'Civil Servants', '公務員'),
(192, 191, 'government official', '国家公務員'),
(193, 191, 'Officials', '官僚'),
(194, 191, 'National tax expert', '国税専門家'),
(195, 191, 'Finance Specialist', '財務専門官'),
(196, 191, 'Labor Standards Inspector', '労働基準監督官'),
(197, 191, 'Self-Defense Force', '自衛隊'),
(198, 191, 'Coast Guard Officer', '海上保安官'),
(199, 191, 'judge', '裁判官'),
(200, 191, 'Court clerk', '裁判所事務官'),
(201, 191, 'Family Court Investigator', '家庭裁判所調査官'),
(202, 191, 'Prosecutor', '検事'),
(203, 191, 'Prosecutor\'s office', '検察事務官'),
(204, 191, 'Prison officer', '刑務官'),
(205, 191, 'Legal instructor', '法務教官'),
(206, 191, 'Immigration inspector', '入国審査官'),
(207, 191, 'Immigration officer', '入国警備官'),
(208, 191, 'Customs officer', '税関職員'),
(209, 191, 'Drug Control Officer', '麻薬取締官'),
(210, 191, 'Royal palace escort', '皇宮護衛官'),
(211, 191, 'House of Councilors / House of Representatives Secretariat staff', '参議院・衆議院事務局職員'),
(212, 191, 'National Diet Library staff', '国会図書館職員'),
(213, 191, 'Local civil servant', '地方公務員'),
(214, 213, 'Local civil servant', '地方公務員'),
(215, 213, 'Police officer', '警察官'),
(216, 213, 'Firefighter', '消防士'),
(217, 213, 'Paramedic', '救急救命士'),
(218, 213, 'City hall staff', '市役所職員'),
(219, 213, 'Food sanitation inspector', '食品衛生監視員'),
(220, 191, 'Financial civil servant system', '金融公務員系'),
(221, 220, 'National Tax Specialist', '国税専門官'),
(222, 220, 'Finance Specialist', '財務専門官'),
(223, 220, 'Tax office staff', '税務署職員'),
(224, 0, 'Trial', '裁判・政治'),
(225, 224, 'judge', '裁判官'),
(226, 224, 'Court clerk', '裁判所事務官'),
(227, 224, 'Family Court Research Center', '家庭裁判所調査館'),
(228, 224, 'Prosecutor', '検事'),
(229, 224, 'Prosecutor\'s office', '検察事務官'),
(230, 224, 'Politics', '政治'),
(231, 230, 'politician', '政治家'),
(232, 230, 'Member of Parliament', '国会議員'),
(233, 230, 'Prefectural assembly member', '県議会議員'),
(234, 230, 'City council member', '市議会議員'),
(235, 230, 'Parliamentary Secretary', '議員秘書'),
(236, 230, 'Policy Secretary', '政策担当秘書'),
(237, 0, 'Medical', '医療系'),
(238, 237, 'Doctor / Nursing', '医師・看護系'),
(239, 238, 'Doctor', '医師'),
(240, 238, 'nurse', '看護師'),
(241, 238, 'Paramedic', '救急救命士'),
(242, 238, 'Public health nurse', '保健師'),
(243, 238, 'Midwife', '助産師'),
(244, 237, 'Medical technician/equipment system', '医療技師・機器系'),
(245, 244, 'Clinical laboratory technology', '臨床検査技術'),
(246, 244, 'Radiological technologist', '診療放射線技師'),
(247, 244, 'Clinical engineer', '臨床工学技士'),
(248, 244, 'Orthoptist', '視能訓練士'),
(249, 244, 'Cytotechnologist', '細胞検査士'),
(250, 244, 'Optometrist', 'オプトメトリスト'),
(251, 244, 'Clinical Development Monitor (CRA)', '臨床開発モニター（CRA）'),
(252, 244, 'Medical device manufacturer', '医療機器メーカー'),
(253, 244, 'Medical device sales company', '医療機器販売会社'),
(254, 237, 'Medical office system', '医療事務系'),
(255, 254, 'Medical office', '医療事務'),
(256, 254, 'Medical secretary', '医療秘書'),
(257, 254, 'Ward Clark', '病棟クラーク'),
(258, 254, 'Medical information manager', '診療情報管理士'),
(259, 254, 'Medical information technologist', '医療情報技師'),
(260, 254, 'Transplant coordinator', '移植コーディネーター'),
(261, 237, 'Pharmacy', '薬学系'),
(262, 261, 'pharmacist', '薬剤師'),
(263, 261, 'mr', 'MR'),
(264, 261, 'Registered seller', '登録販売者'),
(265, 261, 'Clinical trial coordinator', '治験コーディネーター'),
(266, 261, 'Pharmaceutical company employee', '製薬会社社員'),
(267, 261, 'Drugstore capacity', 'ドラッグストア定員'),
(268, 237, 'Dental system', '歯科系'),
(269, 268, 'Dentist', '歯科医師'),
(270, 268, 'Dental hygienist', '歯科衛生士'),
(271, 268, 'Dental technician', '歯科技工士'),
(272, 268, 'Dental assistant', '歯科助手'),
(273, 237, 'Animal medical system', '動物医療系'),
(274, 273, 'Veterinarian', '獣医師'),
(275, 273, 'Animal nurse', '動物看護師'),
(276, 0, 'Psychology / welfare / rehabilitation', '心理・福祉・リハビリ'),
(277, 276, 'Psychological / mental system\r\n', '心理・メンタル系'),
(278, 277, 'Clinical psychologist', '臨床心理士'),
(279, 277, 'Certified psychiatrist', '公認心理士'),
(280, 277, 'Psychological counselor', '心理カウンセラー'),
(281, 277, 'School counselor', 'スクールカウンセラー'),
(282, 277, 'Industrial counselor', '産業カウンセラー'),
(283, 277, 'Career consultant', 'キャリアコンサルタント'),
(284, 277, 'Mental trainer', 'メンタルトレーナー'),
(285, 276, 'Nursing care/welfare/consultation system', '介護・福祉・相談系'),
(286, 285, 'care worker', '介護福祉士'),
(287, 285, 'Social worker', '社会福祉士'),
(288, 285, 'Mental health social worker', '精神保健福祉士'),
(289, 285, 'Care manager', 'ケアマネジャー'),
(290, 285, 'home helper', 'ホームヘルパー'),
(291, 285, 'Social worker', 'ソーシャルワーカー'),
(292, 285, 'Caseworker', 'ケースワーカー'),
(293, 285, 'Life counselor', '生活相談員'),
(294, 285, 'Child instructor', '児童指導員'),
(295, 285, 'Social welfare offic', '社会福祉主事'),
(296, 285, 'Long-term care office work', '介護事務'),
(297, 285, 'Health exercise instructor', '健康運動指導士'),
(298, 285, 'Welfare equipment specialist counselor', '福祉用具専門相談員'),
(299, 285, 'Welfare and living environment coordinator', '福祉住環境コーディネーター'),
(300, 285, 'Sign language interpreter', '手話通訳士'),
(301, 276, 'Rehabilitation system', 'リハビリ系'),
(302, 301, 'physical therapist', '理学療法士'),
(303, 301, 'Occupational therapist', '作業療法士'),
(304, 301, 'Speech therapist', '言語聴覚士'),
(305, 301, 'Judo rehabilitation teacher', '柔道整復師'),
(306, 301, 'Anma Massage Shiatsushi', 'あん摩マッサージ指圧師'),
(307, 301, 'Acupuncturist', '鍼灸師'),
(308, 301, 'chiropractor', '整体師'),
(309, 301, 'Chiropractor', 'カイロプラクター'),
(310, 301, 'Prosthetist', '義肢装具士'),
(311, 301, 'Music therapist', '音楽療法士'),
(312, 276, 'Relaxation system', 'リラクゼーション系'),
(313, 312, 'therapist', 'セラピスト'),
(314, 312, 'Aroma therapist', 'アロマセラピスト'),
(315, 312, 'Reflexologist', 'リフレクソロジスト'),
(316, 0, 'Beauty / fashion', '美容・ファッション'),
(317, 316, 'Beauty / Makeup / Nail', '美容・メイク・ネイル系'),
(318, 317, 'Hairdresser', '美容師'),
(319, 317, 'Makeup artist', 'メイクアップアーティスト'),
(320, 317, 'Manicurist', 'ネイリスト'),
(321, 317, 'Beautician', 'エステティシャン'),
(322, 317, 'Eyelist', 'アイリスト'),
(323, 317, 'Cosmetology member', '美容部員'),
(324, 317, 'Cosmetics maker', '化粧品メーカー'),
(325, 317, 'Barber', '理容師'),
(326, 316, 'Fashion', 'ファッション系'),
(327, 326, 'stylist', 'スタイリスト'),
(328, 326, 'Buyer', 'バイヤー'),
(329, 326, 'Merchandiser', 'マーチャンダイザー'),
(330, 326, 'Fashion advisor', 'ファッションアドバイザー'),
(331, 326, 'Fashion coordinator', 'ファッションコーディネーター'),
(332, 326, 'Apparel maker employee', 'アパレルメーカー社員'),
(333, 326, 'Bridal stylist', 'ブライダルスタイリスト'),
(334, 326, 'Colorist', 'カラリスト'),
(335, 316, 'Clothing / designers', '服飾・デザイナー系'),
(336, 335, 'fashion designer', 'ファッションデザイナー'),
(337, 335, 'Patterner', 'パタンナー'),
(338, 335, 'Textile designer', 'テキスタイルデザイナー'),
(339, 335, 'Japanese dressmaker', '和裁士'),
(340, 335, 'Wedding dress designer', 'ウエディングドレスデザイナー'),
(341, 335, 'Jewelry designer', 'ジュエリーデザイナー'),
(342, 335, 'Kimono master', '着付け師'),
(343, 316, 'Waitress', '接客系'),
(344, 343, 'Shop clerk', 'ショップ店員'),
(345, 343, 'Apparel clerk', 'アパレル店員'),
(346, 343, 'Department store employee', '百貨店社員'),
(347, 343, 'Shoe fitter', 'シューフィッター'),
(348, 343, 'Receptionist', 'レセプショニスト'),
(357, 0, 'international', '国際 '),
(358, 357, 'Trading company man', '商社マン'),
(359, 357, 'Overseas sales', '	\r\n海外営業'),
(360, 357, 'Customs officer', '通関士'),
(361, 357, 'Trade affairs', '貿易事務'),
(362, 357, 'Language system', '語学系'),
(363, 362, 'Interpreter', '通訳'),
(364, 362, 'translator', '翻訳家'),
(365, 362, 'Japanese teache', '日本語教師'),
(366, 357, 'Overseas tourism', '海外観光系'),
(367, 366, 'Licensed guide', '通訳案内士'),
(368, 366, 'Overseas tour guide', '海外ツアーガイド'),
(369, 357, 'support', '海外支援系'),
(370, 369, 'Diplomat', '外交官'),
(371, 369, 'UN staff', '国連職員'),
(372, 369, 'Japan Overseas Cooperation Volunteers', '青年海外協力隊'),
(373, 369, 'JETRO staff', 'JETRO職員\r\n\r\n\r\n'),
(374, 369, 'JICA staff', 'JICA職員'),
(375, 0, 'Travel / Hotel', '旅行・ホテル'),
(376, 375, 'Aviation system', '航空系'),
(377, 376, 'Flight Attendant (CA)', '客室乗務員（CA)'),
(378, 376, 'Grand Staff', 'グランドスタッフ'),
(379, 375, 'Hotel / wedding system', 'ホテル・ウエディング系'),
(380, 379, 'Hotel staff', 'ホテルスタッフ'),
(381, 379, 'Wedding planner', 'ウエディングプランナー'),
(382, 379, 'Concierge', 'コンシェルジュ'),
(383, 379, 'Nakai', '仲居'),
(384, 375, 'Travel / guide system', '旅行・ガイド系'),
(385, 384, 'tour conductor', 'ツアーコンダクター'),
(386, 384, 'Tour planner', 'ツアープランナー'),
(387, 384, 'Tour operator', 'ツアーオペレーター'),
(388, 384, 'Bus guide', 'バスガイド'),
(389, 384, 'Licensed guide', '通訳案内士'),
(390, 384, 'Overseas tour guide', '海外ツアーガイド'),
(391, 384, 'Travel agency', '旅行代理店'),
(392, 384, 'Theme park staff', 'テーマパークスタッフ'),
(393, 0, 'Eating and drinking', '飲食'),
(394, 393, 'Nutrition / cooking system', '栄養・料理系'),
(395, 394, 'Nutritionist', '栄養士'),
(396, 394, 'Registered dietitian', '管理栄養士'),
(397, 394, 'Vegetable sommelier', '野菜ソムリエ'),
(398, 394, 'Cooking expert', '料理研究家\r\n\r\n'),
(399, 394, 'Food coordinator', 'フードコーディネーター'),
(400, 393, 'Cooking / sweets / craftsmanship', '調理・スイーツ・職人系'),
(401, 400, 'Pastry chef', 'パティシエ'),
(402, 400, 'Chocolatier', 'ショコラティエ'),
(403, 400, 'Cooks', '調理師'),
(404, 400, 'Itamae', '板前'),
(405, 400, 'chef', 'シェフ'),
(406, 400, 'Sushi craftsman', '寿司職人'),
(407, 400, 'Japanese sweets craftsman', '和菓子職人'),
(408, 400, 'Breadmaker', 'パン職人'),
(409, 393, 'Beverages and waitresses', '飲料・接客系'),
(410, 400, 'Sommelier', 'ソムリエ'),
(411, 400, 'bartender', 'バーテンダー'),
(412, 400, 'Varistor', 'バリスタ'),
(413, 400, 'Hall staff', 'ホールスタッフ'),
(414, 400, 'restaurant', '飲食店'),
(415, 393, 'Restaurant owner system', '飲食店オーナー系'),
(416, 415, 'Cafe owner', 'カフェオーナー'),
(417, 415, 'Ramen shop manager', 'ラーメン屋店長'),
(418, 415, 'Izakaya manager', '居酒屋店長'),
(419, 393, 'Food and drink related jobs', '飲食関連職'),
(420, 419, 'Food maker employee', '食品メーカー社員'),
(421, 419, 'Beverage maker employee', '飲料メーカー社員'),
(422, 419, 'Food sanitation inspector', '食品衛生監視員'),
(423, 419, 'Perfumer', '調香師'),
(424, 0, 'Sale', '販売'),
(425, 424, 'Sales system', '販売系'),
(426, 425, 'Sales', '販売員'),
(427, 425, 'Shop clerk', 'ショップ店員'),
(428, 425, 'Mobile shop clerk', '携帯ショップ店員'),
(429, 425, 'Food supermarket employee', '食品スーパー社員'),
(430, 425, 'Convenience store manager', 'コンビニ店長'),
(431, 425, 'Pet shop clerk', 'ペットショップ店員'),
(432, 425, 'Demonstrator', '実演販売士'),
(433, 425, 'Telephone operator', 'テレフォンオペレーター'),
(434, 0, 'Education / research / childcare', '教育・研究・保育'),
(435, 434, 'Childcare system', '保育系'),
(436, 435, 'Childminder', '保育士'),
(437, 435, 'kindergarten teacher', '幼稚園教諭'),
(438, 435, 'babysitter', 'ベビーシッター'),
(439, 435, 'Childminder', 'チャイルドマインダー'),
(440, 434, 'Teacher system', '教師系'),
(441, 440, 'Elementary school teacher', '小学校教師'),
(442, 440, 'Junior high school teacher', '中学校教師'),
(443, 440, 'High school teacher', '高校教師'),
(444, 440, 'nursing teacher', '養護教諭'),
(445, 440, 'Special Needs School Teacher', '特別支援学校教諭'),
(446, 434, 'Professor / scholar', '教授・学者系'),
(447, 446, 'University professor', '大学教授'),
(448, 446, 'researcher', '研究者'),
(449, 446, 'the scientist', '科学者'),
(450, 446, 'curator', '学芸員'),
(451, 446, 'psychologist', '心理学者'),
(452, 446, 'Mathematician', '数学者'),
(453, 446, 'physicist', '物理学者'),
(454, 446, 'Archaeologist', '考古学者'),
(455, 446, 'philosopher', '哲学者'),
(456, 434, 'Lecturer system', '講師系'),
(457, 456, 'Cram school teacher', '塾講師'),
(458, 456, 'Preparatory school instructor', '予備校講師'),
(459, 456, 'Japanese teacher', '日本語教師'),
(460, 456, 'Language school staff', '語学学校職員'),
(461, 456, 'Seminar lecturer', 'セミナー講師'),
(462, 456, 'Tutor', '家庭教師'),
(463, 434, 'School affairs / education related jobs', '学校事務・教育関連職'),
(464, 463, 'School affairs', '学校事務'),
(465, 463, 'University staff', '大学職員'),
(466, 463, 'School counselor', 'スクールカウンセラー'),
(467, 434, 'Career education system', 'キャリア教育系'),
(468, 467, 'Vocational training instructor', '職業訓練指導員'),
(469, 467, 'Career consultant', 'キャリアコンサルタント'),
(470, 0, 'Nature / animals', '自然・動物'),
(471, 470, 'Pet system', 'ペット系'),
(472, 471, 'Trimmer', 'トリマー'),
(473, 471, 'Dog trainer', 'ドッグトレーナー'),
(474, 471, 'Breeder', 'ブリーダー'),
(475, 471, 'Pet sitter', 'ペットシッター'),
(476, 471, 'Pet shop clerk', 'ペットショップ店員'),
(477, 470, 'Animal medicine / breeding system', '動物医療・飼育系'),
(478, 477, 'Veterinarian', '獣医師'),
(479, 477, 'Animal nurse', '動物看護師'),
(480, 477, 'Animal keeper', '動物飼育員'),
(481, 477, 'Dolphin trainer', 'ドルフィントレーナー'),
(482, 477, 'Falconer', '鷹匠'),
(483, 477, 'Trainer', '調教師'),
(485, 470, 'Flower / garden system', '花・ガーデン系'),
(486, 485, 'Gardener', '庭師'),
(487, 485, 'Garden designer', 'ガーデンデザイナー'),
(488, 485, 'Florist', '花屋'),
(489, 485, 'Flower coordinator', 'フラワーコーディネーター'),
(490, 470, 'Nature maintenance / weather system', '自然保護・天気系'),
(491, 490, 'Tree doctor', '樹木医'),
(492, 490, 'Forest instructor', '森林インストラクター'),
(493, 490, 'Forest instructor', '森林インストラクター'),
(494, 490, 'Green coordinator', 'グリーンコーディネーター'),
(495, 490, 'Nature Conservation Officer', '自然保護官'),
(496, 490, 'Weather forecaster', '気象予報士'),
(497, 470, 'Agriculture / fishery', '農業・漁業系'),
(498, 497, 'Farmer', '農家'),
(499, 497, 'Fisherman', '漁師'),
(500, 497, 'Dairy', '酪農家'),
(501, 497, 'Chick appraiser', 'ひよこ鑑定士'),
(502, 0, 'Press', '報道'),
(503, 502, 'Press system', '報道系'),
(504, 503, 'Newspaper reporter', '新聞記者'),
(505, 503, 'Journalist', 'ジャーナリスト'),
(506, 503, 'Photographer', 'カメラマン'),
(507, 503, 'Newspaper company', '新聞社'),
(508, 503, 'Shorthand', '速記者'),
(509, 0, 'TV / movies', 'テレビ・映画'),
(510, 509, 'TV / program production system', 'テレビ・番組制作系'),
(511, 510, 'TV producer', 'テレビプロデューサー'),
(512, 510, 'TV director', 'テレビディレクター'),
(513, 510, 'TV station employee', 'テレビ局社員'),
(514, 510, 'TV AD', 'テレビAD'),
(515, 510, 'Program production company employee', '番組制作会社社員'),
(516, 510, 'TV writer\r\n', '放送作家'),
(517, 510, 'Steno Captioner', 'ステノキャプショナー'),
(518, 510, 'TV cameraman', 'テレビカメラマン'),
(519, 0, 'Screenplay / Direction / Movie', '脚本・演出・映画系'),
(520, 519, 'Screenwriter', '脚本家'),
(521, 519, 'Director', '演出家'),
(522, 519, 'Film director', '映画監督'),
(523, 519, 'Movie promotion', '映画宣伝'),
(524, 519, 'Movie distribution company employee', '映画配給会社社員'),
(525, 519, 'Cinematographer (movie cameraman)', '撮影監督（映画カメラマン）'),
(526, 519, 'Video production system', '映像制作系'),
(527, 526, 'Video creator', '映像クリエイター'),
(528, 526, 'Videographer', '映像作家'),
(529, 526, 'Radio writer', '構成作家'),
(530, 519, 'Shooting staff system', '撮影スタッフ系'),
(531, 530, 'Lighting staff', '照明スタッフ'),
(532, 530, 'Art staff', '美術スタッフ'),
(533, 0, 'Music / radio', '音楽・ラジオ'),
(534, 533, 'Musician / singer', 'ミュージシャン・歌手系'),
(535, 534, 'singer', '歌手'),
(536, 534, 'Musician', 'ミュージシャン'),
(537, 534, 'Singer-songwriter', 'シンガーソングライター'),
(538, 533, 'Music production system', '音楽プロデュース系'),
(539, 538, 'Music producer', '音楽プロデューサー'),
(540, 538, 'Composer', '作曲家'),
(541, 538, 'Lyricist', '作詞家'),
(542, 538, 'Arranger', '編曲家'),
(543, 538, 'Recording engineer', 'レコーディングエンジニア'),
(544, 538, 'Sound creator', 'サウンドクリエイター'),
(545, 533, 'Concert system', 'コンサート系'),
(546, 545, 'PA engineer', 'PAエンジニア'),
(547, 545, 'Concert promoter', 'コンサートプロモーター'),
(548, 545, 'Concert staff', 'コンサートスタッフ'),
(549, 545, 'Roadie', 'ローディー'),
(550, 545, 'Stage mechanism adjustment technician', '舞台機構調整技能士'),
(551, 545, 'Acoustic staff', '音響スタッフ'),
(552, 533, 'Classic', 'クラシック系'),
(553, 552, 'pianist', 'ピアニスト'),
(554, 552, 'musician', '音楽家'),
(555, 552, 'Vocal musician', '声楽家'),
(556, 552, 'Conductor', '指揮者'),
(557, 552, 'Piano tuner', 'ピアノ調律師'),
(558, 533, 'Music lesson system', '音楽レッスン系'),
(559, 558, 'Piano instructor', 'ピアノ講師'),
(560, 558, 'Voice trainer', 'ボイストレーナー'),
(561, 533, 'Radio system', 'ラジオ系\r\n'),
(562, 561, 'Radio director', 'ラジオディレクター'),
(563, 561, 'Radio personality', 'ラジオパーソナリティ'),
(564, 561, 'Club DJ', 'クラブDJ'),
(565, 0, 'Art', 'アート・伝統工芸'),
(566, 565, 'Artist', '芸術家'),
(567, 565, 'painter', '画家'),
(568, 565, 'Ceramic artist', '陶芸家'),
(569, 565, 'calligrapher', '書道家'),
(570, 565, 'Flower arrangement', '華道家'),
(571, 565, 'Goldsmith', '彫金師'),
(572, 565, 'Sculptor', '彫刻家'),
(573, 565, 'Printmaker', '版画家'),
(574, 565, 'Buddhist priest', '仏師'),
(575, 0, 'Performing arts / net', '芸能・ネット'),
(576, 575, 'Talent / laughter', 'タレント・お笑い系'),
(577, 576, 'Entertainer / talent', '芸能人・タレント'),
(578, 576, 'Comedian', 'お笑い芸人'),
(579, 575, 'Singer / idol / voice actor', '歌手・アイドル・声優系'),
(580, 579, 'singer', '歌手'),
(581, 579, 'Musician', 'ミュージシャン'),
(582, 579, 'Idol', 'アイドル'),
(583, 579, 'Voice actor', '声優'),
(584, 575, 'Actor / stage system', '俳優・舞台系'),
(585, 584, 'Actor / actress', '俳優・女優'),
(586, 584, 'Stage actor (theatrical troupe member)', '舞台俳優（劇団員）'),
(587, 575, 'Internet system', 'インターネット系'),
(588, 587, 'YouTuber', 'ユーチューバー'),
(589, 587, 'Instagrammer', 'インスタグラマー'),
(590, 575, 'News coverage', 'ニュース報道系'),
(591, 590, 'announcer', 'アナウンサー'),
(592, 590, 'Radio personality', 'ラジオパーソナリティ'),
(593, 590, 'narrator', 'ナレーター'),
(594, 590, 'news caster', 'ニュースキャスター'),
(595, 590, 'reporter', 'リポーター'),
(596, 575, 'Model system', 'モデル系'),
(597, 596, 'model', 'モデル'),
(598, 596, 'Event companion', 'イベントコンパニオン'),
(599, 596, 'Race queen', 'レースクイーン'),
(600, 575, 'Traditional performing arts', '伝統芸能系'),
(601, 600, 'Kabuki actor', '歌舞伎役者'),
(602, 600, 'Rakugoka', '落語家'),
(603, 600, 'Maiko', '舞妓'),
(604, 600, 'geisha', '芸者'),
(605, 600, 'Nogaku artist', '能楽師'),
(606, 600, 'Fireworks', '花火師'),
(607, 575, 'Performing arts related jobs', '芸能関連職'),
(609, 607, 'Entertainment manager', '芸能マネージャー'),
(610, 607, 'Stuntman', 'スタントマン'),
(611, 0, 'Sports', 'スポーツ'),
(612, 611, 'Trainer system', 'トレーナー系'),
(613, 612, 'Sports instructor', 'スポーツインストラクター'),
(614, 612, 'Yoga instructor', 'ヨガインストラクター'),
(615, 612, 'Sports trainer', 'スポーツトレーナー'),
(616, 612, 'Athletic trainer', 'アスレティックトレーナー'),
(617, 612, 'Personal trainer', 'パーソナルトレーナー'),
(618, 612, 'Outdoor instructor', 'アウトドアインストラクター'),
(619, 612, 'Diving instructor', 'ダイビングインストラクター'),
(620, 612, 'Health exercise practice leader', '健康運動実践指導者'),
(621, 612, 'Recreation instructor', 'レクリエーションインストラクター'),
(622, 611, 'Ball game sports system', '球技スポーツ系'),
(623, 622, 'Soccer player', 'サッカー選手'),
(624, 622, 'Professional baseball player', 'プロ野球選手'),
(625, 622, 'Professional golfer', 'プロゴルファー'),
(626, 622, 'Tennis player', 'テニス選手'),
(627, 622, 'Volleyball player', 'バレーボール選手'),
(628, 622, 'Basketball player', 'バスケットボール選手'),
(629, 622, 'Rugby player', 'ラグビー選手'),
(630, 611, 'Dance system', 'ダンス系'),
(631, 630, 'dancer', 'ダンサー'),
(632, 630, 'ballerina', 'バレリーナ'),
(633, 630, 'Choreographer', '振付師'),
(634, 630, 'Cheerleader', 'チアリーダー'),
(635, 630, 'Professional skater', 'プロスケーター'),
(636, 611, 'Fighting system', '格闘系'),
(637, 636, 'Professional wrestler', 'プロレスラー'),
(638, 636, 'Professional boxer', 'プロボクサー'),
(639, 636, 'Kickboxer', 'キックボクサー'),
(640, 636, 'Wrestler', '	\r\n力士'),
(641, 611, 'Competition / Race / Competition', '競争・レース・競技系'),
(642, 641, 'Jockey', '騎手'),
(643, 641, 'Bicycle racer', '競輪選手'),
(644, 641, 'Boat racer', '競艇選手'),
(645, 641, 'Athletics', '陸上選手'),
(646, 641, 'Swimmers', '水泳選手'),
(647, 641, 'road racer', 'ロードレーサー'),
(648, 641, 'racer', 'レーサー'),
(649, 641, 'bodybuilder', 'ボディビルダー'),
(650, 641, 'Go player', '棋士'),
(651, 641, 'Professional gamer', 'プロゲーマー'),
(652, 611, 'Sports related occupation', 'スポーツ関連職系'),
(653, 652, 'Sports agent', 'スポーツエージェント'),
(654, 652, 'Sports cameraman', 'スポーツカメラマン'),
(655, 652, 'Sports writer', 'スポーツライター'),
(656, 652, 'Referee', '審判'),
(657, 652, 'Gyoji', '行司'),
(658, 652, 'Caddy', 'キャディ'),
(659, 652, 'Groundsman', 'グラウンドキーパー'),
(660, 0, 'Mailing / Transportation', '郵送・運送'),
(661, 660, 'Airframe operation system', '機体操作系'),
(662, 661, 'pilot', 'パイロット'),
(663, 661, 'Train driver', '電車運転士'),
(664, 661, 'Navigator', '航海士'),
(665, 661, 'astronaut', '	\r\n宇宙飛行士'),
(666, 660, 'Vehicle driving system', '車両運転系'),
(667, 666, 'driver', '運転手'),
(668, 666, 'Taxi driver', 'タクシー運転手'),
(669, 666, 'Truck driver', 'トラック運転手'),
(670, 666, 'Bus driver', 'バス運転手'),
(671, 666, 'Sales driver', 'セールスドライバー'),
(672, 660, 'Maintenance system', '整備系'),
(673, 672, 'Aircraft maintenance technician', '航空整備士'),
(674, 672, 'Auto mechanic', '自動車整備士'),
(675, 660, 'Operation management system', '運行管理系'),
(676, 675, 'Air Traffic Controller Dispatcher Train Conductor Customs Clearance', '航空管制官 ディスパッチャー 車掌 通関士'),
(677, 675, 'Transport-related jobs', '運輸関連職'),
(678, 675, 'Railroad company employee Airline company employee Shipping company employee', '鉄道会社社員 航空会社社員 海運会社社員'),
(679, 0, 'Funeral / religion', '葬祭・宗教'),
(680, 679, 'Funeral / religious', '葬祭・宗教系'),
(681, 679, 'Monk (priest / boy)', '僧侶（住職・坊さん）'),
(682, 679, 'Shinto priest / priest', '神職・神主'),
(683, 679, 'Father / pastor', '神父・牧師'),
(684, 679, 'Funeral director', '葬儀屋'),
(685, 679, 'Nōkanshi', '納棺師'),
(686, 0, 'Other', 'その他'),
(687, 686, 'Home care system', 'ホームケア系'),
(688, 687, 'Housekeeper', '家政婦'),
(689, 687, 'Key master', '鍵師'),
(690, 687, 'Butler', '執事'),
(691, 686, 'Professional system', '専門系'),
(692, 691, 'magician', '	\r\nマジシャン'),
(693, 691, 'Casino dealer', 'カジノディーラー'),
(694, 691, 'Detective', '探偵'),
(695, 691, 'mercenary', '傭兵'),
(696, 691, 'fortune teller', '占い師'),
(697, 691, 'Adventurer', '冒険家'),
(698, 691, 'Mountaineer', '登山家'),
(699, 691, 'Certificate clerk', '賞状書士'),
(700, 691, 'Handyman', '便利屋'),
(701, 686, 'security', '保安'),
(702, 701, 'Private security system', '民間警備系'),
(703, 701, 'Security guard', '警備員'),
(704, 701, 'bodyguard', 'ボディーガード');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(100) NOT NULL,
  `user_social_id` varchar(225) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_social_link` varchar(200) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_phone_number` varchar(100) NOT NULL,
  `user_profile_photo` varchar(225) NOT NULL,
  `user_background_photo` varchar(225) NOT NULL,
  `user_background_video` varchar(255) NOT NULL,
  `user_profile_video` varchar(225) NOT NULL,
  `user_login_type` varchar(225) NOT NULL,
  `user_registration_step` int(100) NOT NULL,
  `user_activity_area` varchar(225) NOT NULL,
  `company_name` varchar(225) NOT NULL,
  `company_url` varchar(225) NOT NULL,
  `occupation` varchar(225) NOT NULL,
  `job_history` longtext NOT NULL,
  `skills` varchar(225) NOT NULL,
  `annonymous_mode` varchar(225) NOT NULL DEFAULT 'false',
  `facebook` varchar(225) NOT NULL,
  `instagram` varchar(225) NOT NULL,
  `twitter` varchar(225) NOT NULL,
  `linkdin` varchar(225) NOT NULL,
  `youtube` varchar(225) NOT NULL,
  `github` varchar(225) NOT NULL,
  `wantedly` varchar(225) NOT NULL,
  `recess_status` varchar(225) NOT NULL DEFAULT 'false',
  `withdraw_status` varchar(225) NOT NULL DEFAULT 'false',
  `realtime_talk` varchar(225) NOT NULL DEFAULT 'false',
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_social_id`, `user_name`, `first_name`, `last_name`, `user_social_link`, `user_email`, `user_phone_number`, `user_profile_photo`, `user_background_photo`, `user_background_video`, `user_profile_video`, `user_login_type`, `user_registration_step`, `user_activity_area`, `company_name`, `company_url`, `occupation`, `job_history`, `skills`, `annonymous_mode`, `facebook`, `instagram`, `twitter`, `linkdin`, `youtube`, `github`, `wantedly`, `recess_status`, `withdraw_status`, `realtime_talk`, `activity_time`) VALUES
(14, 'twitter231#', 'vaibhav', 'vaibhav', 'Singh', '', 'vaibhavr121@gmail.com', '', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_profile_photo/user-14-image.png', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_background_photo/user-14-video.mp4', '', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_profile_photo/user-14-video.mp4', 'twitter', 3, 'riding', 'DoozyCodSystems', 'www.doozycodsystems.com', 'Website Developer', 'NAN', 'a:3:{i:0;s:9:\"wordpress\";i:1;s:7:\"magento\";i:2;s:3:\"php\";}', 'true', 'www.facebook.com', 'www.instagram.com', 'www.twitter.com', 'www.linkdin.com', 'www.youtube.com', 'www.github.com', 'www.wantedly.com', 'true', 'true', 'true', '2021-07-07 07:41:00'),
(13, '#gdds24356128', '', '', '', '', 'vaibhavr121@gmail.com', '', '', '', '', '', 'facebook', 1, '', '', '', '', '', '', 'false', '', '', '', '', '', '', '', 'false', 'false', 'false', '2021-07-07 06:55:48'),
(12, '#gdfu1sds24356128', '', '', '', '', 'vaibhavr121@gmail.com', '', '', '', '', '', 'facebook', 1, '', '', '', '', '', '', 'false', '', '', '', '', '', '', '', 'false', 'false', 'false', '2021-07-07 06:55:48'),
(11, '3595454644012898', 'Anoop Dhiman', 'Anoop', 'Dhiman', '', '', '', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_profile_photo/user-11-image.png', '', '', '', 'facebook', 3, 'hokkaido', 'Doozycod System', 'www.doozycod.in', 'Software developer', 'I have 1.6 years  worki on mobile app development', 'a:3:{i:0;s:2:\"19\";i:1;s:2:\"20\";i:2;s:2:\"21\";}', 'false', '', '', '', '', '', '', '', 'false', 'false', 'true', '2021-08-16 12:47:19'),
(23, 'eA7xEeyZR-', 'Vaibhav Rajput', '', '', '', 'vaibhavr121@gmail.com', '', '', '', '', '', 'linkedin', 1, '', '', '', '', '', '', 'false', '', '', '', '', '', '', '', 'false', 'false', 'false', '2021-07-07 06:55:48'),
(32, '966530758130114560', 'Anoop Dhiman', '', '', '', 'uic.17mca8037@gmail.com', '', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_profile_photo/user-32-image.png', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_background_photo/user-32-image.png', '', 'https://www.doozycodsys.com/NEXUS/API/uploads/user_profile_photo/user-32-image.png', 'twitter', 3, 'iwate', 'Doozycod system', 'www.doozycod.in', 'Fjkd ', 'Fdhfgjdsf efhfdj', 'a:1:{i:0;s:2:\"96\";}', 'false', 'https://www.facebook.com', 'https://instagram.com/', 'https://twitter.com/', 'https://linkdin.com/', 'https://youtube.com/', 'https://twitter.com/', 'https://', 'false', 'true', 'true', '2021-07-29 06:16:45'),
(35, '102590992047843', 'Donna Donkk', 'Donna', 'Donkk', 'https://www.facebook.com', 'donna_keoapyw_donna@tfbnw.net', '', 'https://scontent-nrt1-1.xx.fbcdn.net/v/t1.30497-1/cp0/c15.0.50.50a/p50x50/84628273_176159830277856_972693363922829312_n.jpg?_nc_cat=1&ccb=1-3&_nc_sid=12b3be&_nc_ohc=Mb8nvAG1p5UAX-WAv6j&_nc_ht=scontent-nrt1-1.xx&tp=27&oh=6522e', '', '', '', 'facebook', 3, 'kagoshima', '', '', 'aa', 'fbb\n\n', 'a:1:{i:0;s:3:\"100\";}', 'false', 'https://www.facebook.com/hanna', 'https://instagram.com/', 'https://twitter.com/', 'https://linkdin.com/', 'https://youtube.com/', 'https://twitter.com/', 'https://', 'true', 'false', 'true', '2021-07-12 06:15:15'),
(36, '1102220914446364672', 'witaiz', 'witaiz', '', 'https://twitter.com/', 'ngthna53@gmail.com', '', 'https://unavatar.vercel.app/twitter/witaiz', '', '', '', 'twitter', 3, 'aomori', '', '', 'bb', 'kk', 'a:1:{i:0;s:2:\"77\";}', 'true', 'https://www.facebook.com', 'https://instagram.com/', 'https://twitter.com/', 'https://linkdin.com/', 'https://youtube.com/', 'https://twitter.com/', 'https://', 'false', 'false', 'false', '2021-07-10 04:55:10'),
(37, '548587986319115', 'Yamada Tarou', 'Yamada', 'Tarou', 'https://www.facebook.com', 'ngthna53@gmail.com', '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=548587986319115&height=50&width=50&ext=1628645681&hash=AeTnbJLfinIkpVa9ljs', '', '', '', 'facebook', 3, 'tokyo', '', '', 'CEO', '????', 'a:1:{i:0;s:2:\"14\";}', 'false', '', '', '', '', '', '', '', 'false', 'false', 'false', '2021-07-12 02:18:28'),
(38, 'iejcX3mCW6', 'Deshpreet Bedi', 'Deshpreet', 'Bedi', 'https://www.linkdin.com/', 'Deshpreet.bedi@gmail.com', '', 'https://media-exp3.licdn.com/dms/image/C4E03AQFIvNJCQHCebA/profile-displayphoto-shrink_800_800/0/1616406839958?e=1631750400&v=beta&t=XWo99kmkuW2Cv-VH1aZd3Os5VbKNFUKqh_4lHGoT1Bs', '', '', '', 'linkedin', 3, 'akita', 'Doozycod ', 'www.Doozycodsys.com', 'Nothing ', 'NaN', 'a:1:{i:0;s:1:\"2\";}', 'false', '', '', '', '', '', '', '', 'false', 'false', 'true', '2021-08-16 11:00:45'),
(50, '2850732361855111', 'Vaibhav Patial', 'Vaibhav', 'Patial', 'https://www.facebook.com/2850732361855111', 'vaibhavr121@gmail.com', '', 'https://nexus.doozycodsystems.com/API/uploads/user_profile_photo/user-50-image.png', '', '', '', 'facebook', 3, 'niigata', 'Doozy cod system', 'Doozy cod system', 'WebDevloper', 'fjh,c,hmcj,c,j', 'a:9:{i:0;s:2:\"45\";i:1;s:2:\"46\";i:2;s:2:\"47\";i:3;s:2:\"49\";i:4;s:2:\"50\";i:5;s:2:\"51\";i:6;s:3:\"358\";i:7;s:3:\"359\";i:8;s:3:\"360\";}', 'false', '', '', '', '', '', '', '', 'false', 'false', 'true', '2021-08-16 12:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_match`
--

CREATE TABLE `user_match` (
  `match_id` int(100) NOT NULL,
  `send_by_user_id` int(100) NOT NULL,
  `send_to_user_id` int(100) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_match`
--

INSERT INTO `user_match` (`match_id`, `send_by_user_id`, `send_to_user_id`, `status`) VALUES
(1, 14, 11, 'success'),
(2, 14, 11, 'success'),
(3, 14, 11, 'success');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `notification_id` int(100) NOT NULL,
  `sender_id` int(100) NOT NULL,
  `reciever_id` int(225) NOT NULL,
  `read_status` varchar(225) NOT NULL,
  `time` varchar(225) NOT NULL,
  `notifications` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`notification_id`, `sender_id`, `reciever_id`, `read_status`, `time`, `notifications`) VALUES
(1, 50, 11, 'false', '2021-08-16 18:44:12', 'Missed Call by Vaibhav Patial'),
(2, 50, 11, 'false', '2021-08-16 18:49:53', 'Missed Call by Vaibhav Patial'),
(3, 50, 11, 'false', '2021-08-16 18:52:58', 'Missed Call by Vaibhav Patial'),
(4, 11, 50, 'false', '2021-08-16 18:55:44', 'Missed Call by Anoop Dhiman'),
(5, 11, 50, 'false', '2021-08-16 18:56:07', 'Missed Call by Anoop Dhiman'),
(6, 11, 50, 'false', '2021-08-16 18:56:33', 'Missed Call by Anoop Dhiman'),
(7, 11, 50, 'false', '2021-08-16 18:57:11', 'Missed Call by Anoop Dhiman'),
(8, 11, 50, 'false', '2021-08-16 18:59:05', 'Missed Call by Anoop Dhiman'),
(9, 11, 38, 'false', '2021-08-16 18:59:47', 'Missed Call by Anoop Dhiman');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification_setting`
--

CREATE TABLE `user_notification_setting` (
  `user_id` int(100) NOT NULL,
  `push_new_message` varchar(225) NOT NULL DEFAULT 'true',
  `push_recommend` varchar(225) NOT NULL DEFAULT 'true',
  `push_matching` varchar(225) NOT NULL DEFAULT 'true',
  `push_realtime_talk` varchar(225) NOT NULL DEFAULT 'true',
  `push_news` varchar(225) NOT NULL DEFAULT 'true',
  `email_new_message` varchar(225) NOT NULL DEFAULT 'true',
  `email_recommend` varchar(225) NOT NULL DEFAULT 'true',
  `email_matching` varchar(225) NOT NULL DEFAULT 'true',
  `email_realtime_talk` varchar(225) NOT NULL DEFAULT 'true',
  `email_news` varchar(225) NOT NULL DEFAULT 'true'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notification_setting`
--

INSERT INTO `user_notification_setting` (`user_id`, `push_new_message`, `push_recommend`, `push_matching`, `push_realtime_talk`, `push_news`, `email_new_message`, `email_recommend`, `email_matching`, `email_realtime_talk`, `email_news`) VALUES
(14, 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true'),
(32, 'true', 'false', 'true', '', 'false', 'true', 'false', 'false', 'false', 'false'),
(35, 'true', 'true', 'true', '', 'true', 'false', 'false', 'true', 'true', 'true'),
(36, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(11, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(37, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(38, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(40, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(0, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_purpose_of_use`
--

CREATE TABLE `user_purpose_of_use` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `skills` varchar(225) NOT NULL,
  `funding` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `alliance` varchar(225) NOT NULL,
  `investment` varchar(225) NOT NULL,
  `business_plan` longtext NOT NULL,
  `status` varchar(225) NOT NULL,
  `vision` text NOT NULL,
  `strength` text NOT NULL,
  `supplement` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_purpose_of_use`
--

INSERT INTO `user_purpose_of_use` (`id`, `user_id`, `purpose`, `skills`, `funding`, `industry`, `alliance`, `investment`, `business_plan`, `status`, `vision`, `strength`, `supplement`) VALUES
(84, 37, '4', 'N;', 'N;', 'N;', 'N;', 'N;', '', '', '', '', ''),
(83, 37, '1', 'a:4:{i:0;s:2:\"19\";i:1;s:2:\"20\";i:2;s:2:\"21\";i:3;s:2:\"96\";}', 'a:0:{}', 'a:4:{i:0;s:2:\"16\";i:1;s:2:\"17\";i:2;s:2:\"18\";i:3;s:2:\"19\";}', 'a:0:{}', 'N;', '??', 'Planning Stage', '', '', ''),
(82, 11, '2', 'a:3:{i:0;s:2:\"49\";i:1;s:2:\"55\";i:2;s:2:\"50\";}', 'a:0:{}', 'a:1:{i:0;s:2:\"39\";}', 'a:0:{}', 'N;', 'All unmarried person find life partner', 'Planning Stage', 'Do not any person single', '1', '1'),
(79, 35, '2', 'a:3:{i:0;s:2:\"45\";i:1;s:2:\"46\";i:2;s:2:\"47\";}', 'a:0:{}', 'a:1:{i:0;s:2:\"45\";}', 'a:0:{}', 'N;', 'bhj', 'Planning Stage', '', '', ''),
(80, 36, '1', 'a:3:{i:0;s:2:\"91\";i:1;s:2:\"92\";i:2;s:2:\"93\";}', 'a:0:{}', 'a:1:{i:0;s:2:\"43\";}', 'a:0:{}', 'N;', 'gh', 'Planning Stage', '', '', ''),
(81, 36, '1', 'a:1:{i:0;s:2:\"49\";}', 'a:0:{}', 'a:1:{i:0;s:2:\"43\";}', 'a:0:{}', 'N;', 'gg', 'Preparation Stage', '', '', ''),
(88, 32, '3', 'a:16:{i:0;s:2:\"57\";i:1;s:2:\"49\";i:2;s:2:\"51\";i:3;s:2:\"52\";i:4;s:2:\"10\";i:5;s:2:\"11\";i:6;s:2:\"84\";i:7;s:2:\"85\";i:8;s:2:\"86\";i:9;s:2:\"87\";i:10;s:2:\"81\";i:11;s:2:\"18\";i:12;s:2:\"17\";i:13;s:2:\"19\";i:14;s:2:\"20\";i:15;s:2:\"21\";}', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;s:2:\"45\";}', 'a:2:{i:0;s:2:\"45\";i:1;s:2:\"55\";}', 'N;', 'Ghfgygfg', '', '', 'Nvftv', 'Klgtdtg'),
(72, 14, '3', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"4\";i:2;s:1:\"4\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"2\";}', 'a:0:{}', 'tewgvduhwgeidgwesoidhaslbflasfsa', 'progreesss', 'winning', '10', '104'),
(70, 14, '1', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:0:{}', 'tewgvduhwgeidgwesoidhaslbflasfsa', 'progreesss', 'winning', '10', '101'),
(71, 14, '2', 'a:3:{i:0;s:1:\"4\";i:1;s:1:\"5\";i:2;s:1:\"6\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"4\";i:2;s:1:\"3\";}', 'a:0:{}', 'tewgvduhwgeidgwesoidhaslbflasfsa', 'progreesss', 'winning', '10', '101'),
(92, 40, '3', 'a:2:{i:0;s:2:\"45\";i:1;s:2:\"48\";}', 'a:0:{}', 'a:1:{i:0;s:2:\"44\";}', 'a:0:{}', 'N;', 'Dhnxz gh CD', '', '', '', ''),
(91, 38, '2', 'a:3:{i:0;s:2:\"19\";i:1;s:2:\"20\";i:2;s:2:\"21\";}', 'a:0:{}', 'a:1:{i:0;s:2:\"30\";}', 'a:0:{}', 'N;', 'NAN', 'Planning Stage', '', '100', '100'),
(93, 50, '6', 'N;', 'N;', 'N;', 'N;', 'a:1:{i:0;s:1:\"1\";}', '', '', '', '', ''),
(94, 50, '1', 'a:2:{i:0;s:2:\"80\";i:1;s:2:\"81\";}', 'a:1:{i:0;s:1:\"3\";}', 'a:2:{i:0;s:2:\"79\";i:1;s:2:\"78\";}', 'a:1:{i:0;s:2:\"68\";}', 'N;', 'Fyd\n\n', 'Planning Stage', 'Yhh', 'Yuyu', 'Ggh');

-- --------------------------------------------------------

--
-- Table structure for table `user_talk_later_match`
--

CREATE TABLE `user_talk_later_match` (
  `match_id` int(100) NOT NULL,
  `sender_id` int(100) NOT NULL,
  `receiver_id` int(100) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_zoom_meeting`
--

CREATE TABLE `user_zoom_meeting` (
  `id` int(100) NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `sender_id` int(100) NOT NULL,
  `receiver_id` int(100) NOT NULL,
  `meeting_password` varchar(100) NOT NULL,
  `meeting_status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_zoom_meeting`
--

INSERT INTO `user_zoom_meeting` (`id`, `meeting_id`, `sender_id`, `receiver_id`, `meeting_password`, `meeting_status`) VALUES
(22, '84250329238', 50, 11, '12345', 'cencel'),
(23, '85398124040', 50, 11, '12345', 'cencel'),
(24, '88588026987', 50, 11, '12345', 'cencel'),
(25, '87389091801', 11, 50, '12345', 'cencel'),
(26, '89821290298', 50, 11, '12345', 'cencel'),
(27, '88428482140', 11, 50, '12345', 'calling'),
(28, '83340437732', 11, 50, '12345', 'cencel'),
(29, '85210759426', 50, 11, '12345', 'calling'),
(30, '82102181034', 11, 50, '12345', 'calling'),
(31, '85695938810', 50, 11, '12345', 'cencel'),
(32, '87988066959', 50, 11, '12345', 'calling'),
(33, '82035932274', 50, 11, '12345', 'cencel'),
(34, '83087847927', 50, 11, '12345', 'cencel'),
(35, '85225758840', 50, 11, '12345', 'done'),
(36, '82953092264', 11, 50, '12345', 'cencel'),
(37, '81040972217', 11, 50, '12345', 'cencel'),
(38, '89003594450', 11, 50, '12345', 'cencel'),
(39, '86282496472', 11, 50, '12345', 'cencel'),
(40, '83877106464', 11, 50, '12345', 'cencel'),
(41, '81437332616', 11, 38, '12345', 'cencel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_area`
--
ALTER TABLE `activity_area`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `buisness_funding`
--
ALTER TABLE `buisness_funding`
  ADD PRIMARY KEY (`funding_id`);

--
-- Indexes for table `buisness_status`
--
ALTER TABLE `buisness_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hidden_users`
--
ALTER TABLE `hidden_users`
  ADD PRIMARY KEY (`hidden_id`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `Investment`
--
ALTER TABLE `Investment`
  ADD PRIMARY KEY (`investment_id`);

--
-- Indexes for table `purpose_category`
--
ALTER TABLE `purpose_category`
  ADD PRIMARY KEY (`purpose_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_match`
--
ALTER TABLE `user_match`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `user_notification_setting`
--
ALTER TABLE `user_notification_setting`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_purpose_of_use`
--
ALTER TABLE `user_purpose_of_use`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_talk_later_match`
--
ALTER TABLE `user_talk_later_match`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `user_zoom_meeting`
--
ALTER TABLE `user_zoom_meeting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_area`
--
ALTER TABLE `activity_area`
  MODIFY `activity_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `buisness_status`
--
ALTER TABLE `buisness_status`
  MODIFY `status_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `industry_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `Investment`
--
ALTER TABLE `Investment`
  MODIFY `investment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purpose_category`
--
ALTER TABLE `purpose_category`
  MODIFY `purpose_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=705;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_match`
--
ALTER TABLE `user_match`
  MODIFY `match_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `notification_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_purpose_of_use`
--
ALTER TABLE `user_purpose_of_use`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `user_zoom_meeting`
--
ALTER TABLE `user_zoom_meeting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
