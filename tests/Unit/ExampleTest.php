<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Employee;
use Tests\TestCase;
use App\Http\Repositories\EmployeeRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    
    public function __construct()
    {
      parent::__construct();
      $this->employeeRepository = new EmployeeRepository();
    }
    /**
     * @test
     */
    public function it_can_find_employee()
    {
       $data = factory('App\Employee')->create();

      $employee =  $this->employeeRepository->findEmployee($data->employee_id);

      $this->assertInstanceOf(Employee::class, $employee);

      $this->assertEquals($employee->employee_id, $data->employee_id);
    }

      /**
       *
       * @test
       */
    public function it_can_get_all_employees()
    {
        $data = factory('App\Employee', 50)->create();

        $employees = $this->employeeRepository->getAllEmployees();
      
        $this->assertEquals($employees->count(), $data->count());
    }

    
}
