<?php

namespace QiQiuYun\SDK;

use QiQiuYun\SDK\Exception\SDKException;

final class XAPIActivityTypes
{
    const APPLICATION = 'application';

    const AUDIO = 'audio';

    const CLASS_ONLINE = 'class-online';

    const COURSE = 'course';

    const ONLINE_DISCUSSION = 'online-discussion';

    const DOCUMENT = 'document';

    const EXERCISE = 'exercise';

    const HOMEWORK = 'homework';

    const INTERACTION = 'interaction';

    const LIVE = 'live';

    const MESSAGE = 'message';

    const QUESTION = 'question';

    const TEST_PAPER = 'testpaper';

    const VIDEO = 'video';

    public static function getFullName($shortName)
    {
        static $nameMaps = array(
            self::APPLICATION => 'http://activitystrea.ms/schema/1.0/application',
            self::AUDIO => 'http://activitystrea.ms/schema/1.0/audio',

            self::COURSE => 'http://adlnet.gov/expapi/activities/course',
            self::INTERACTION => 'http://adlnet.gov/expapi/activities/interaction',
            self::QUESTION => 'http://adlnet.gov/expapi/activities/question',

            self::ONLINE_DISCUSSION => 'https://w3id.org/xapi/acrossx/activities/online-discussion',
            self::DOCUMENT => 'https://w3id.org/xapi/acrossx/activities/document',
            self::CLASS_ONLINE => 'https://w3id.org/xapi/acrossx/activities/class-online',
            self::VIDEO => 'https://w3id.org/xapi/acrossx/activities/video',
            self::MESSAGE => 'https://w3id.org/xapi/acrossx/activities/message',

            self::LIVE => 'http://xapi.edusoho.com/activities/live',
            self::HOMEWORK => 'http://xapi.edusoho.com/activities/homework',
            self::EXERCISE => 'http://xapi.edusoho.com/activities/exercise',
            self::TEST_PAPER => 'http://xapi.edusoho.com/activities/testpaper',
        );

        if (isset($nameMaps[$shortName])) {
            return $nameMaps[$shortName];
        } else {
            throw new SDKException('UnSupport activity type');
        }
    }

}