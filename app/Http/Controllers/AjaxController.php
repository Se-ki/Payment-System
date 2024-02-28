<?php

namespace App\Http\Controllers;

use App\Helper\PS;
use App\Models\LoginUser;
use App\Models\Payment;
use App\Models\StudentPaymentRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Number;
use Yajra\DataTables\DataTables;

class AjaxController extends Controller
{
    public function getStudent(LoginUser $loginUser, DataTables $dataTables)
    {
        $users = $loginUser->students();
        return $dataTables->eloquent($users)
            ->addColumn('school_id', fn ($row, PS $pS) => $pS->addHyphenAfterFourNumbers($row->student->school_id))
            ->addColumn('fullname', fn ($row) => $this->getFullName($row))
            ->addColumn('action', function ($row) {
                return "<li class='nav-item dropdown'>
            <a class='btn btn-flat p-1 btn-default btn-sm dropdown-toggle btn-outline-primary dropdown-icon'
                data-bs-toggle='dropdown'>
                Action
            </a>
            <div class='dropdown-menu' role='menu'>
                <a class='dropdown-item'
                    href='{$this->urlToPayments($row->username)}'><span
                        class='fa fa-edit text-primary fw-bold m-2'></span>Payments</a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item'
                    href='{$this->urlToBalance($row->username)}'><span
                        class='fa fa-regular fa-money-bill-1 text-danger fw-bold m-2'></span>
                    Balance</a>
            </div>
        </li>";
            })->rawColumns(['action'])->toJson();
    }
    protected function urlToPayments(string $username)
    {
        return route('balance.student.payment.index', ['student' => $username]);
    }
    protected function urlToBalance(string $username)
    {
        return route('balance.show', $username);
    }
    public function getPayments(Payment $payment, DataTables $dataTables)
    {
        $payments = $payment->paymentFilter();
        return $dataTables
            ->eloquent($payments)
            ->addColumn('academic_year', fn ($row) => "<td>{$row->academic->year}</td>")
            ->addColumn('description', fn ($row) => "<td>{$row->description->name}</td>")
            ->addColumn('amount', fn ($row, Number $number) => "<td>{$number->currency($row->amount, in: 'PHP', locale: 'ph')}</td>")
            ->addColumn('date_posted', fn ($row, Carbon $carbon) => "<td>{$carbon->parse($row->created_at)->format('F d, Y')}</td>")
            ->addColumn('record_by', fn ($row) => $this->getRecordBy($row))
            ->addColumn('action', fn ($row) => "<td>
                    <a class='btn btn-outline-primary ' data-toggle='modal' id='paymentButton'
                        data-target='#paymentModal'
                        data-attr='{$this->modalFormPayment($row)}' title='Pay'>
                        Pay
                    </a>
                </td>")
            ->rawColumns(['academic_year', 'description', 'amount', 'date_posted', 'record_by', 'action'])->toJson();
    }
    protected function modalFormPayment(object $payment)
    {
        return route('payments.show', $payment->id);
    }
    protected function getFirstChar(string $middlename)
    {
        return substr($middlename, 0, 1);
    }

    public function getRecords(StudentPaymentRecord $studentPaymentRecord, DataTables $dataTables)
    {
        $records = $studentPaymentRecord->studentRecordsFilter(request(['semester', 'year']));
        return $dataTables->eloquent($records)
            ->addColumn('student', fn ($row) => "<td>{$this->getFullName($row)}</td>")
            ->rawColumns(['student'])->toJson();
    }
    protected function getFullName(object $name)
    {
        return $name->student->middlename === null ? $name->student->lastname . ", " . $name->student->firstname : $name->student->lastname . ", " . $name->student->firstname . " " . $this->getFirstChar($name->student->middlename) . '.';
    }

    public function getAllPayments(DataTables $dataTables, Payment $payment)
    {
        $payments = $payment->getAllPayments();
        return $dataTables->eloquent($payments)
            ->addColumn('student_id', fn ($row, PS $pS) => "<td>{$pS->addHyphenAfterFourNumbers($row->student->school_id)}</td>")
            ->addColumn('student_name', fn ($row) => "<td>{$this->getFullName($row)}</td>")
            ->addColumn('description', fn ($row) => "<td>{$row->description->name}</td>")
            ->addColumn('amount', fn ($row, Number $number) => "<td>{$number->currency(number:$row->amount, in: "PHP")}</td>")
            ->addColumn('date_post', fn ($row, Carbon $carbon) => "<td>{$carbon->parse($row->date_post)->format('F d, Y')}</td>")
            ->addColumn('record_by', fn ($row) => $this->getRecordBy($row))
            ->rawColumns(['student_id', 'student_name', 'description', 'amount', 'date_post', 'record_by'])->toJson();
    }
    protected function getRecordBy($row)
    {
        return $row->recordBy->middlename == null ?
            "<td>{$row->recordBy->lastname}, {$row->recordBy->firstname}</td>" :
            "<td>{$row->recordBy->lastname}, {$row->recordBy->firstname} {$this->getFirstChar($row->recordBy->middlename)}.</td>";
    }
}
