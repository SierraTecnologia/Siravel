<?php
/**
 * Api em Python para se conectar ao Test Link
 * 
 * https://github.com/orenault/TestLink-API-Python-client/blob/master/doc/usage.rst
 */

 class TestlinkApi
 {
     protected $pipRepository = 'TestLink-API-Python-client';

     public function installCommand()
     {
        return 'pip install '.$this->pipRepository.'';
     }

     /**
      * Connect TestLink, count existing projects and get test case data:
      */
     public function projects()
     {

        $python = '[PYENV]\testlink\Scripts\activate
        set TESTLINK_API_PYTHON_SERVER_URL=http://[YOURSERVER]/testlink/lib/api/xmlrpc/v1/xmlrpc.php
        set TESTLINK_API_PYTHON_DEVKEY=[Users devKey generated by TestLink]
        python
        >>> import testlink
        >>> tls = testlink.TestLinkHelper().connect(testlink.TestlinkAPIClient)
        >>> tls.countProjects()
        3';
        $python .= ">>> tls.getTestCase(None, testcaseexternalid='NPROAPI3-1')";
        $python .= "[{'full_tc_external_id': 'NPROAPI3-1', 'node_order': '0', 'is_open': '1', 'id': '2757', ...}]";
        return $python;
     }

     public function createTaskPlan()
     {
        $python = 'import testlink
        tlh = testlink.TestLinkHelper()
        tls = tlh.connect(testlink.TestlinkAPIClient)';
        $python .= "print tls.whatArgs('createTestPlan')";
        $python .= '> createTestPlan(<testplanname>, <testprojectname>, [note=<note>], [active=<active>],
                         [public=<public>], [devKey=<devKey>])
        >  create a test plan';
        return $python;
     }
 }