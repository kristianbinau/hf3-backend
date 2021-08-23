<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/departments/{departmentId}/employees",
     *      operationId="EmployeeController.index",
     *      tags={"Locations"},
     *      summary="Get list of employees in department",
     *      description="Returns list of employees  in department",
     *      @OA\Parameter(
     *          name="departmentId",
     *          description="Department Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              default=1
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function index(Department $department)
    {
        return Response($department->employees()->paginate(500));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/employees/{employeeId}",
     *      operationId="EmployeeController.store",
     *      tags={"Locations"},
     *      summary="Store employee",
     *      description="Stores employee and returns Get employee",
     *      @OA\Parameter(
     *          name="employeeId",
     *          description="Employee Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'bail|required|integer|exists:departments,id',
            'address_id' => 'bail|required|integer|exists:addresses,id',
            'login_id' => 'bail|required|integer|exists:logins,id|unique:customer,login_id|unique:employee,login_id',
            'name' => 'bail|required|max:255',
        ]);

        $employee = Employee::create($request->all());

        return $this->show($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/employees/{employeeId}",
     *      operationId="EmployeeController.show",
     *      tags={"Locations"},
     *      summary="Get employee",
     *      description="Returns Get employee",
     *      @OA\Parameter(
     *          name="employeeId",
     *          description="Employee Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function show(Employee $employee)
    {
        return Response($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/employees/{employeeId}",
     *      operationId="EmployeeController.update",
     *      tags={"Locations"},
     *      summary="Update employee",
     *      description="Updates employee and returns Get employee",
     *      @OA\Parameter(
     *          name="employeeId",
     *          description="Employee Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'department_id' => 'bail|integer|exists:departments,id',
            'address_id' => 'bail|integer|exists:addresses,id',
            'login_id' => 'bail|integer|exists:logins,id|unique:customer,login_id|unique:employee,login_id',
            'name' => 'bail|max:255',
        ]);

        $employee->update($request->all());

        return $this->show($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *      path="/api/employees/{employeeId}",
     *      operationId="EmployeeController.show",
     *      tags={"Locations"},
     *      summary="Delete employee",
     *      description="Deletes employee and returns nothing",
     *      @OA\Parameter(
     *          name="employeeId",
     *          description="Employee Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return Response('', 204);
    }
}
