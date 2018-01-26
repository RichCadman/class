/*
Navicat MySQL Data Transfer

Source Server         : baonakang
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : class

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-11-13 14:47:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for class_admin
-- ----------------------------
DROP TABLE IF EXISTS `class_admin`;
CREATE TABLE `class_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员表',
  `admin` varchar(255) DEFAULT NULL COMMENT '后台用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for class_detail
-- ----------------------------
DROP TABLE IF EXISTS `class_detail`;
CREATE TABLE `class_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '积分详情表',
  `user_id` int(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT '积分类型',
  `point` varchar(255) DEFAULT NULL COMMENT '获得积分',
  `time` varchar(255) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11729 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for class_join
-- ----------------------------
DROP TABLE IF EXISTS `class_join`;
CREATE TABLE `class_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '统计参加人数表',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `add_time` varchar(255) DEFAULT NULL COMMENT '参加时间',
  `photo` varchar(255) DEFAULT NULL COMMENT '学员头像',
  `nick_name` varchar(255) DEFAULT NULL COMMENT '昵称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3637 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for class_problem
-- ----------------------------
DROP TABLE IF EXISTS `class_problem`;
CREATE TABLE `class_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '题目表',
  `title` varchar(255) DEFAULT NULL COMMENT '题目',
  `content` text COMMENT '题目内容',
  `add_time` varchar(255) DEFAULT NULL COMMENT '添加题目时间',
  `result` text COMMENT '电子版答案解析',
  `video_result` varchar(255) DEFAULT NULL COMMENT '视频答案解析',
  `datetime` varchar(255) DEFAULT NULL COMMENT '日期格式时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for class_share
-- ----------------------------
DROP TABLE IF EXISTS `class_share`;
CREATE TABLE `class_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '添加分享内容表',
  `content` text COMMENT '分享内容',
  `time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for class_student
-- ----------------------------
DROP TABLE IF EXISTS `class_student`;
CREATE TABLE `class_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '学员表',
  `openid` varchar(255) DEFAULT NULL COMMENT '微信openid',
  `wx_name` varchar(255) DEFAULT NULL COMMENT '微信名',
  `wx_photo` varchar(255) DEFAULT NULL COMMENT '微信头像',
  `add_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `last_punch_time` varchar(255) DEFAULT NULL COMMENT '最后打卡时间',
  `count` int(11) DEFAULT '0' COMMENT '连续打卡次数',
  `point` int(255) DEFAULT '0' COMMENT '积分',
  `share_num` int(11) DEFAULT '0' COMMENT '分享朋友圈标记次数   100最大值',
  `share_date_time` varchar(255) DEFAULT NULL COMMENT '分享日期时间',
  `share_time` varchar(255) DEFAULT NULL COMMENT '最后一次分享时间',
  `invitation` varchar(255) DEFAULT NULL COMMENT '分享人的openID 用来给分享人加积分用',
  `max_count` int(255) DEFAULT '0' COMMENT '最长打卡次数',
  `total_count` int(255) DEFAULT '0' COMMENT '共打卡多少天',
  `today_point` int(11) DEFAULT '0' COMMENT '今日获得积分',
  `clear` int(11) DEFAULT NULL COMMENT '清积分判断',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6118 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for class_submit
-- ----------------------------
DROP TABLE IF EXISTS `class_submit`;
CREATE TABLE `class_submit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '提交答案表',
  `user_id` int(11) DEFAULT NULL COMMENT '提交学生id',
  `problem_id` int(11) DEFAULT NULL COMMENT '题目id',
  `sub_title` varchar(255) DEFAULT NULL COMMENT '题目标题',
  `sub_content1` varchar(255) DEFAULT NULL COMMENT '提交答案图片1',
  `time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `add_time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `old` int(11) DEFAULT '0' COMMENT '是否过期打卡',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8255 DEFAULT CHARSET=utf8;
