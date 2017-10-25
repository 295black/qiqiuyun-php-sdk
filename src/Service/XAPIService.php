<?php
namespace QiQiuYun\SDK\Service;

class XAPIService extends BaseService
{
    protected $baseUri = 'http://localhost:8000';

    protected $defaultLang = 'zh-CN';

    /**
     * 提交“观看视频”的学习记录
     *
     * @return void
     */
    public function watchVideo($actor, $object, $result)
    {
        $statement = array();
        $statement['actor'] = array('account' => $actor);
        $statement['verb'] = array(
            'id' => 'https://w3id.org/xapi/acrossx/verbs/watched',
            'display' => array(
                'zh-CN' => '观看了',
                'en-US' => 'watched'
            )
        );
        $statement['object'] = array(
            'id' => $object['id'],
            'defination' => array(
                'type' => 'https://w3id.org/xapi/acrossx/activities/video',
                'name' => array(
                    $this->defaultLang => $object['name'],
                ),
                'extensions' => array (
                    'http://xapi.edusoho.com/extensions/course' => array(
                        'id' => $object['course']['id'],
                        'title' => $object['course']['title'],
                        'description' => $object['course']['description'],
                    ),
                    'http://xapi.edusoho.com/extensions/resource' => array(
                        'id' => $object['video']['id'],
                        'name' => $object['video']['name'],
                    )
                )
            )
        );

        $statement['result'] = array(
            'duration' => $this->convertTime($result['duration']),
            'extensions' => array(
                'http://id.tincanapi.com/extension/starting-point' => $this->convertTime($result['starting_point']),
                'http://id.tincanapi.com/extension/ending-point' => $this->convertTime($result['ending_point']),
            ),
        );

        $this->pushStatement($statement);
    }

    /**
     * 提交“完成任务”的学习记录
     *
     * @return void
     */
    public function finishActivity()
    {

    }

    /**
     * 提交“完成任务的弹题”的学习记录
     *
     * @return void
     */
    public function finishActivityQuestion()
    {

    }

    /**
     * 提交“完成作业”的学习记录
     *
     * @return void
     */
    public function finishHomework()
    {

    }

    /**
     * 提交“完成练习”的学习记录
     *
     * @return void
     */
    public function finishExercise()
    {

    }

    /**
     * 提交“完成考试”的学习记录
     *
     * @return void
     */
    public function finishTestpaper()
    {

    }

    /**
     * 提交“记笔记”的学习记录
     *
     * @return void
     */
    public function writeNote()
    {

    }

    /**
     * 提交“提问题”的学习记录
     *
     * @return void
     */
    public function askQuestion()
    {

    }

    /**
     * 提交学习记录
     *
     * @return void
     */
    public function pushStatement($statement)
    {
        $statement['context'] = array(
            'extensions' => array (
                'http://xapi.edusoho.com/extensions/school' => $this->context,
            )
        );

        $response = $this->client->request('POST', 'statements', array(
            'json' => $statement,
            'headers' => array(
                'Authorization' => 'Signature '. $this->makeSignature(),
            )
        ));
    }

    public function makeSignature()
    {
        $deadline = strtotime(date('Y-m-d H:0:0', strtotime('+2 hours')));
        $signingText = $this->auth->getAccessKey()."\n".$deadline;
        return $this->auth->sign($signingText);
    }
}