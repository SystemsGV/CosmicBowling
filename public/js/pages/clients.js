"use strict";
$(function () {
  let t, a, n;
  n = (
    isDarkStyle
      ? ((t = config.colors_dark.borderColor),
        (a = config.colors_dark.bodyBg),
        config.colors_dark)
      : ((t = config.colors.borderColor),
        (a = config.colors.bodyBg),
        config.colors)
  ).headingColor;
  var e,
    s = $(".datatables-users"),
    i = $(".select2"),
    l = "app-user-view-account.html",
    o = {
      1: { title: "Pending", class: "bg-label-warning" },
      2: { title: "Active", class: "bg-label-success" },
      3: { title: "Inactive", class: "bg-label-secondary" },
    };
  i.length &&
    ((i = i),
    select2Focus(i),
    i
      .wrap('<div class="position-relative"></div>')
      .select2({ placeholder: "Select Country", dropdownParent: i.parent() })),
    s.length &&
      (e = s.DataTable({
        ajax: assetsPath + "json/user-list.json",
        columns: [
          { data: "id" },
          { data: "full_name" },
          { data: "role" },
          { data: "current_plan" },
          { data: "billing" },
          { data: "avatar" },
          { data: "status" },
          { data: "id" },
        ],
        columnDefs: [
          {
            className: "control",
            searchable: !1,
            orderable: !1,
            responsivePriority: 2,
            targets: 0,
            render: function (e, t, a, n) {
              return "";
            },
          },

          {
            targets: 1,
            responsivePriority: 4,
            render: function (e, t, a, n) {
              var s = a.full_name,
                i = a.email,
                o = a.avatar;
              return (
                '<div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3">' +
                (o
                  ? '<img src="' +
                    assetsPath +
                    "img/avatars/" +
                    o +
                    '" alt="Avatar" class="rounded-circle">'
                  : '<span class="avatar-initial rounded-circle bg-label-' +
                    [
                      "success",
                      "danger",
                      "warning",
                      "info",
                      "dark",
                      "primary",
                      "secondary",
                    ][Math.floor(6 * Math.random())] +
                    '">' +
                    (o = (
                      ((o = (s = a.full_name).match(/\b\w/g) || []).shift() ||
                        "") + (o.pop() || "")
                    ).toUpperCase()) +
                    "</span>") +
                '</div></div><div class="d-flex flex-column"><a href="' +
                l +
                '" class="text-truncate"><span class="fw-medium text-heading">' +
                s +
                "</span></a><small>" +
                i +
                "</small></div></div>"
              );
            },
          },
          {
            targets: 2,
            render: function (e, t, a, n) {
              a = a.role;
              return (
                "<span class='text-truncate d-flex align-items-center'>" +
                {
                  Subscriber:
                    '<i class="mdi mdi-account-outline mdi-20px text-primary me-2"></i>',
                  Author:
                    '<i class="mdi mdi-cog-outline mdi-20px text-warning me-2"></i>',
                  Maintainer:
                    '<i class="mdi mdi-chart-donut mdi-20px text-success me-2"></i>',
                  Editor:
                    '<i class="mdi mdi-pencil-outline mdi-20px text-info me-2"></i>',
                  Admin:
                    '<i class="mdi mdi-laptop mdi-20px text-danger me-2"></i>',
                }[a] +
                a +
                "</span>"
              );
            },
          },
          {
            targets: 3,
            render: function (e, t, a, n) {
              return '<span class="text-heading">' + a.current_plan + "</span>";
            },
          },
          {
            targets: 5,
            render: function (e, t, a, n) {
              a = a.status;
              return (
                '<span class="badge rounded-pill ' +
                o[a].class +
                '" text-capitalized>' +
                o[a].title +
                "</span>"
              );
            },
          },
          {
            targets: -1,
            title: "Actions",
            searchable: !1,
            orderable: !1,
            render: function (e, t, a, n) {
              return (
                '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical mdi-20px"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="' +
                l +
                '" class="dropdown-item"><i class="mdi mdi-eye-outline me-2"></i><span>View</span></a><a href="javascript:;" class="dropdown-item"><i class="mdi mdi-pencil-outline me-2"></i><span>Edit</span></a><a href="javascript:;" class="dropdown-item delete-record"><i class="mdi mdi-delete-outline me-2"></i><span>Delete</span></a></div></div>'
              );
            },
          },
        ],
        order: [[2, "desc"]],
        dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0 gap-3"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          sLengthMenu: "Show _MENU_",
          search: "",
          searchPlaceholder: "Search..",
        },
        buttons: [
          {
            extend: "collection",
            className:
              "btn btn-label-secondary dropdown-toggle me-3 waves-effect waves-light",
            text: '<i class="mdi mdi-export-variant me-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            buttons: [
              {
                extend: "print",
                text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, a) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("user-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
                customize: function (e) {
                  $(e.document.body)
                    .css("color", n)
                    .css("border-color", t)
                    .css("background-color", a),
                    $(e.document.body)
                      .find("table")
                      .addClass("compact")
                      .css("color", "inherit")
                      .css("border-color", "inherit")
                      .css("background-color", "inherit");
                },
              },
              {
                extend: "csv",
                text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, a) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("user-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
              {
                extend: "excel",
                text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, a) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("user-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
              {
                extend: "pdf",
                text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, a) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("user-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
              {
                extend: "copy",
                text: '<i class="mdi mdi-content-copy me-1"></i>Copy',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, a) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("user-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
            ],
          },
          {
            text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add User</span>',
            className: "add-new btn btn-primary waves-effect waves-light",
            attr: {
              "data-bs-toggle": "offcanvas",
              "data-bs-target": "#offcanvasAddUser",
            },
          },
        ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (e) {
                return "Details of " + e.data().full_name;
              },
            }),
            type: "column",
            renderer: function (e, t, a) {
              a = $.map(a, function (e, t) {
                return "" !== e.title
                  ? '<tr data-dt-row="' +
                      e.rowIndex +
                      '" data-dt-column="' +
                      e.columnIndex +
                      '"><td>' +
                      e.title +
                      ":</td> <td>" +
                      e.data +
                      "</td></tr>"
                  : "";
              }).join("");
              return !!a && $('<table class="table"/><tbody />').append(a);
            },
          },
        },
        initComplete: function () {
          this.api()
            .columns(3)
            .every(function () {
              var t = this,
                a = $(
                  '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
                )
                  .appendTo(".user_role")
                  .on("change", function () {
                    var e = $.fn.dataTable.util.escapeRegex($(this).val());
                    t.search(e ? "^" + e + "$" : "", !0, !1).draw();
                  });
              t.data()
                .unique()
                .sort()
                .each(function (e, t) {
                  a.append('<option value="' + e + '">' + e + "</option>");
                });
            }),
            this.api()
              .columns(4)
              .every(function () {
                var t = this,
                  a = $(
                    '<select id="UserPlan" class="form-select text-capitalize"><option value=""> Select Plan </option></select>'
                  )
                    .appendTo(".user_plan")
                    .on("change", function () {
                      var e = $.fn.dataTable.util.escapeRegex($(this).val());
                      t.search(e ? "^" + e + "$" : "", !0, !1).draw();
                    });
                t.data()
                  .unique()
                  .sort()
                  .each(function (e, t) {
                    a.append('<option value="' + e + '">' + e + "</option>");
                  });
              }),
            this.api()
              .columns(6)
              .every(function () {
                var t = this,
                  a = $(
                    '<select id="FilterTransaction" class="form-select text-capitalize"><option value=""> Select Status </option></select>'
                  )
                    .appendTo(".user_status")
                    .on("change", function () {
                      var e = $.fn.dataTable.util.escapeRegex($(this).val());
                      t.search(e ? "^" + e + "$" : "", !0, !1).draw();
                    });
                t.data()
                  .unique()
                  .sort()
                  .each(function (e, t) {
                    a.append(
                      '<option value="' +
                        o[e].title +
                        '" class="text-capitalize">' +
                        o[e].title +
                        "</option>"
                    );
                  });
              });
        },
      })),
    $(".datatables-users tbody").on("click", ".delete-record", function () {
      e.row($(this).parents("tr")).remove().draw();
    }),
    setTimeout(() => {
      $(".dataTables_filter .form-control").removeClass("form-control-sm"),
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
}),
  (function () {
    var e = document.querySelectorAll(".phone-mask"),
      t = document.getElementById("addNewUserForm");
    e &&
      e.forEach(function (e) {
        new Cleave(e, { phone: !0, phoneRegionCode: "US" });
      }),
      FormValidation.formValidation(t, {
        fields: {
          userFullname: {
            validators: { notEmpty: { message: "Please enter fullname " } },
          },
          userEmail: {
            validators: {
              notEmpty: { message: "Please enter your email" },
              emailAddress: {
                message: "The value is not a valid email address",
              },
            },
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: "",
            rowSelector: function (e, t) {
              return ".mb-4";
            },
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          autoFocus: new FormValidation.plugins.AutoFocus(),
        },
      });
  })();
