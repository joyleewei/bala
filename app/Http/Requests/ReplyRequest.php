<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules(){
        return [
            'cont' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'cont.required' => '回复的内容不能为空',
            'cont.min' => '回复的内容不能少于2个字符'
        ];
    }
}
