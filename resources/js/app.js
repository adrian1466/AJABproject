import './bootstrap';
import { jsPDF } from 'jspdf';
import autoTable from 'jspdf-autotable';

$(function () {
    const $tableBody = $('#studentsTableBody');
    const $studentForm = $('#studentForm');
    const $message = $('#ajaxMessage');
    const $search = $('#studentSearch');
    const $pagination = $('#studentPagination');
    const $summary = $('#studentTableSummary');
    const canManageStudents = $studentForm.length > 0;
    const syncKey = 'students-table-updated-at';
    let lastSyncValue = null;
    let currentPage = 1;
    let lastPagination = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest',
        },
    });

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function showMessage(type, text) {
        if (!$message.length) {
            return;
        }

        $message
            .removeClass('success error')
            .addClass(type)
            .text(text);
    }

    function clearMessage() {
        $message.removeClass('success error').text('');
    }

    function validationMessage(xhr) {
        if (xhr.responseJSON && xhr.responseJSON.errors) {
            return Object.values(xhr.responseJSON.errors).flat().join(' ');
        }

        if (xhr.responseJSON && xhr.responseJSON.message) {
            return xhr.responseJSON.message;
        }

        return 'Something went wrong. Please try again.';
    }

    function resetForm() {
        if (!$studentForm.length) {
            return;
        }

        $studentForm[0].reset();
        $('#studentRecordId').val('');
        $('.create-only-field').show();
        $('#formTitle').text('Add Student');
        $('#saveStudentBtn').html('<i class="bi bi-save"></i>Save Student');
    }

    function studentRow(student) {
        const encodedStudent = encodeURIComponent(JSON.stringify(student));
        const actionColumn = canManageStudents
            ? `
                <td>
                    <div class="actions">
                        <button type="button" class="btn btn-warning edit-student" data-student="${encodedStudent}">
                            <i class="bi bi-pencil-square"></i>Edit
                        </button>
                        <button type="button" class="btn btn-danger delete-student" data-id="${student.id}">
                            <i class="bi bi-trash"></i>Delete
                        </button>
                    </div>
                </td>
            `
            : '';

        return `
            <tr data-id="${student.id}">
                <td>${escapeHtml(student.id)}</td>
                <td>${escapeHtml(student.student_id || '')}</td>
                <td>${escapeHtml(student.first_name || '')}</td>
                <td>${escapeHtml(student.last_name || '')}</td>
                <td>${escapeHtml(student.degree ? student.degree.degree_title : 'No Degree')}</td>
                <td>${escapeHtml(student.email || '')}</td>
                <td>${escapeHtml(student.contact_number || '')}</td>
                ${actionColumn}
            </tr>
        `;
    }

    function renderPagination(pagination) {
        lastPagination = pagination;

        if (!$pagination.length || !pagination) {
            return;
        }

        $summary.text(
            pagination.total
                ? `Showing ${pagination.from} to ${pagination.to} of ${pagination.total} records`
                : 'No records to show'
        );

        const prevDisabled = pagination.current_page <= 1 ? 'disabled' : '';
        const nextDisabled = pagination.current_page >= pagination.last_page ? 'disabled' : '';

        $pagination.html(`
            <button type="button" class="btn btn-secondary page-btn" data-page="${pagination.current_page - 1}" ${prevDisabled}>
                <i class="bi bi-chevron-left"></i>Previous
            </button>
            <span>Page ${pagination.current_page} of ${pagination.last_page || 1}</span>
            <button type="button" class="btn btn-secondary page-btn" data-page="${pagination.current_page + 1}" ${nextDisabled}>
                Next<i class="bi bi-chevron-right"></i>
            </button>
        `);
    }

    function loadStudents(page = 1) {
        if (!$tableBody.length) {
            return;
        }

        currentPage = page;
        const colSpan = canManageStudents ? 8 : 7;
        $tableBody.html(`<tr><td colspan="${colSpan}" class="loading-row">Loading student records...</td></tr>`);

        $.get('/students/ajax/list', {
            search: $search.val() || '',
            page,
            per_page: 8,
        })
            .done(function (response) {
                if (!response.students.length) {
                    $tableBody.html(`<tr><td colspan="${colSpan}" class="loading-row">No student records found.</td></tr>`);
                    renderPagination(response.pagination);
                    return;
                }

                $tableBody.html(response.students.map(studentRow).join(''));
                renderPagination(response.pagination);
            })
            .fail(function () {
                $tableBody.html(`<tr><td colspan="${colSpan}" class="loading-row">Unable to load student records.</td></tr>`);
            });
    }

    function syncOtherOpenPages() {
        localStorage.setItem(syncKey, Date.now().toString());
    }

    async function fetchExportRows(url) {
        const response = await $.get(url, { search: $search.val() || '' });
        return response.records || [];
    }

    function exportRowsToPdf(rows, title) {
        const doc = new jsPDF({ orientation: 'landscape' });
        doc.setFontSize(16);
        doc.text(title, 14, 16);
        doc.setFontSize(10);
        doc.text(`Generated by AJAB on ${new Date().toLocaleString()}`, 14, 24);

        autoTable(doc, {
            startY: 30,
            head: [['Student ID', 'Name', 'Degree', 'Email', 'Contact', 'Address']],
            body: rows.map((row) => [
                row.student_id || '',
                row.full_name || '',
                row.degree || '',
                row.email || '',
                row.contact_number || '',
                row.address || '',
            ]),
            styles: { fontSize: 8 },
            headStyles: { fillColor: [6, 20, 45] },
        });

        doc.save(`${title.toLowerCase().replace(/[^a-z0-9]+/g, '-')}.pdf`);
    }

    function exportRowsToExcel(rows, title) {
        const headers = ['Student ID', 'Name', 'Degree', 'Email', 'Contact', 'Address'];
        const body = rows.map((row) => [
            row.student_id || '',
            row.full_name || '',
            row.degree || '',
            row.email || '',
            row.contact_number || '',
            row.address || '',
        ]);
        const tableRows = [headers, ...body]
            .map((columns, index) => {
                const tag = index === 0 ? 'th' : 'td';
                return `<tr>${columns.map((column) => `<${tag}>${escapeHtml(column)}</${tag}>`).join('')}</tr>`;
            })
            .join('');
        const workbookHtml = `
            <html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        table { border-collapse: collapse; }
                        th { background: #06142d; color: #ffffff; }
                        th, td { border: 1px solid #c7d7ee; padding: 8px; }
                    </style>
                </head>
                <body>
                    <h1>${escapeHtml(title)}</h1>
                    <p>Generated by AJAB on ${escapeHtml(new Date().toLocaleString())}</p>
                    <table>${tableRows}</table>
                </body>
            </html>
        `;
        const blob = new Blob([workbookHtml], {
            type: 'application/vnd.ms-excel;charset=utf-8',
        });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `${title.toLowerCase().replace(/[^a-z0-9]+/g, '-')}.xls`;
        link.click();
        URL.revokeObjectURL(link.href);
    }

    $('.export-records').on('click', async function () {
        const $button = $(this);
        const originalText = $button.html();
        const format = $button.data('format');
        const url = $button.data('url') || '/students/export-data';
        const title = $button.data('title') || 'AJAB Student Records';

        $button.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i>Exporting');

        try {
            const rows = await fetchExportRows(url);

            if (!rows.length) {
                showMessage('error', 'No records available to export.');
                return;
            }

            if (format === 'excel') {
                exportRowsToExcel(rows, title);
            } else {
                exportRowsToPdf(rows, title);
            }

            showMessage('success', `${title} export is ready.`);
        } catch (error) {
            showMessage('error', 'Unable to export records right now.');
        } finally {
            $button.prop('disabled', false).html(originalText);
        }
    });

    if ($studentForm.length) {
        $studentForm.on('submit', function (event) {
            event.preventDefault();
            clearMessage();

            const id = $('#studentRecordId').val();
            const url = id ? `/students/${id}` : '/students';
            const formData = $studentForm.serializeArray();

            if (id) {
                formData.push({ name: '_method', value: 'PUT' });
            }

            $.post(url, $.param(formData))
                .done(function (response) {
                    showMessage('success', response.message);
                    resetForm();
                    loadStudents(currentPage);
                    syncOtherOpenPages();
                })
                .fail(function (xhr) {
                    showMessage('error', validationMessage(xhr));
                });
        });

        $('#resetStudentBtn').on('click', function () {
            clearMessage();
            resetForm();
        });

        $tableBody.on('click', '.edit-student', function () {
            const student = JSON.parse(decodeURIComponent($(this).attr('data-student')));

            clearMessage();
            $('#studentRecordId').val(student.id);
            $('#student_id').val(student.student_id);
            $('#first_name').val(student.first_name);
            $('#last_name').val(student.last_name);
            $('#address').val(student.address);
            $('#contact_number').val(student.contact_number);
            $('#email').val(student.email);
            $('#degree_id').val(student.degree_id);
            $('#username').val('');
            $('#password').val('');
            $('.create-only-field').hide();
            $('#formTitle').text(`Update ${student.first_name} ${student.last_name}`);
            $('#saveStudentBtn').html('<i class="bi bi-check2-circle"></i>Update Student');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        $tableBody.on('click', '.delete-student', function () {
            const id = $(this).data('id');

            if (!confirm('Are you sure you want to delete this student?')) {
                return;
            }

            clearMessage();

            $.ajax({
                url: `/students/${id}`,
                method: 'POST',
                data: {
                    _method: 'DELETE',
                },
            })
                .done(function (response) {
                    showMessage('success', response.message);
                    loadStudents(lastPagination && currentPage > lastPagination.last_page ? lastPagination.last_page : currentPage);
                    syncOtherOpenPages();
                })
                .fail(function (xhr) {
                    showMessage('error', validationMessage(xhr));
                });
        });
    }

    $search.on('input', function () {
        window.clearTimeout($search.data('timer'));
        $search.data('timer', window.setTimeout(() => loadStudents(1), 250));
    });

    $pagination.on('click', '.page-btn', function () {
        const page = Number($(this).data('page'));

        if (page > 0 && (!lastPagination || page <= lastPagination.last_page)) {
            loadStudents(page);
        }
    });

    window.addEventListener('storage', function (event) {
        if (event.key === syncKey && event.newValue !== lastSyncValue) {
            lastSyncValue = event.newValue;
            loadStudents(currentPage);
        }
    });

    loadStudents();
});
