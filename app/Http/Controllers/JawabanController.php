<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JawabanController extends Controller
{
    public function satu()
    {
        $data ="[{'name':'john mayor', 'age':21},{'name':'john adaptor', 'age':32},{'name':'valdoru buntoras', 'age':11}]";

        // Decode JSON data
        
        return view('satu',compact('data'));
    }

    public function dua(){

        $students = [
            ['name' => 'Sarjono', 'class' => '12 Sains'],
            ['name' => 'Murdoko', 'class' => '11 Sains'],
            ['name' => 'Miswati', 'class' => '10 Sains'],
            ['name' => 'John Mutulendo', 'class' => '10 Language'],
            ['name' => 'Rinawati', 'class' => '11 Sains'],
            ['name' => 'Samawi', 'class' => '12 Sains']
        ];

        //soal A
        function AscorDesc($students)
        {
            $names = array_column($students, 'name');
            array_multisort($names, SORT_DESC, $students);
            return $students;
        }
        
        $jawabanA = AscorDesc($students);

        
        //soal B
        function addClassNum($students)
        {
            foreach ($students as &$student) {
                $class = explode(' ', $student['class']);
                $student['class_num'] = (int) $class[0];
                $student['class_text'] = $class[1];
            }

            return $students;
        }

        $jawabanB = addClassNum($students);

        //soal C
        function filterNum($jawabanB, $classNum)
        {
            return array_filter($jawabanB, function ($jawabanB) use ($classNum) {
                return $jawabanB['class_num'] != $classNum;
            });
        }
        $classNum = 11;

        $jawabanC = filterNum($jawabanB, $classNum);

        return dd($jawabanC);
    }

    public function empat()
    {
        $member = Member::all();
    
        return view('empat', compact('member'));
    }


    public function simpan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $member = new Member();
        $member->name = $request->input('name');
        $member->password = md5($request->input('password'));
        $member->created_date = Carbon::now();
        $member->member_code = $this->MemberCode();
        $member->save();

        return response()->json(['success' => true, 'message' => 'Member created successfully']);
    }

    public function MemberCode()
    {
        $today = Carbon::today()->format('Ymd');
        $count = Member::whereDate('created_at', Carbon::today())->count();
        $count++;
        $memberCode = $today . str_pad($count, 3, '0', STR_PAD_LEFT);
        return $memberCode;
    }


}


