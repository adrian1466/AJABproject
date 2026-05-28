@extends('layouts.app')

@section('title', 'AJAB Student Records')

@section('content')
    <div class="ajax-toolbar">
        <div>
            <h1>AJAB Student Records</h1>
            <p>Add, update, search, export, and maintain student records.</p>
        </div>
        <div class="action-row">
            <button type="button" class="btn btn-secondary export-records" data-format="pdf" data-title="AJAB Student Records">
                <i class="bi bi-file-earmark-pdf"></i>PDF
            </button>
            <button type="button" class="btn btn-success export-records" data-format="excel" data-title="AJAB Student Records">
                <i class="bi bi-file-earmark-spreadsheet"></i>Excel
            </button>
        </div>
    </div>

    <div id="ajaxMessage" class="ajax-message"></div>

    <section class="ajax-card">
        <h2 id="formTitle">Add Student</h2>

        <form id="studentForm" action="{{ route('students.store') }}" method="POST">
            @csrf
            <input type="hidden" id="studentRecordId" name="id">

            <div class="ajax-form-grid">
                <div>
                    <label for="student_id">Student ID</label>
                    <input type="text" name="student_id" id="student_id">
                </div>

                <div>
                    <label for="degree_id">Degree</label>
                    <select name="degree_id" id="degree_id">
                        <option value="">-- Select Degree --</option>
                        @foreach($degrees as $degree)
                            <option value="{{ $degree->id }}">{{ $degree->degree_title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name">
                </div>

                <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name">
                </div>

                <div>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address">
                </div>

                <div>
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" inputmode="numeric">
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="create-only-field">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>

                <div class="create-only-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
            </div>

            <div class="ajax-actions">
                <button type="submit" class="btn btn-primary" id="saveStudentBtn">
                    <i class="bi bi-save"></i>Save Student
                </button>
                <button type="button" class="btn btn-secondary" id="resetStudentBtn">
                    <i class="bi bi-arrow-counterclockwise"></i>Clear
                </button>
            </div>
        </form>
    </section>

    <section class="ajax-card">
        <div class="section-heading compact">
            <div>
                <span>Directory</span>
                <h2>Student Records</h2>
            </div>
            <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="studentSearch" placeholder="Search records">
            </div>
        </div>

        <div class="ajax-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Degree</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentsTableBody">
                    @forelse($students as $student)
                        <tr data-id="{{ $student->id }}">
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->degree->degree_title ?? 'No Degree' }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->contact_number }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-warning" href="{{ route('students.edit', $student) }}">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="loading-row">No student records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <span id="studentTableSummary">
                @if($students->total())
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} records
                @else
                    No records to show
                @endif
            </span>
            <div id="studentPagination" class="pagination-controls"></div>
        </div>
        <noscript>
            {{ $students->links() }}
        </noscript>
    </section>
@endsection
