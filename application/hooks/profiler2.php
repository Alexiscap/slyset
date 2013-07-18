<?php

class MY_Profiler2 {

    private $CI;

    public function enable() {
        $this->CI = & get_instance();

        $this->CI->output->enable_profiler(TRUE);
    }

}
