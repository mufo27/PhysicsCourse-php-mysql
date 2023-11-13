<script src="../assets/dist/js/vendors.bundle.js"></script>
<script src="../assets/dist/js/app.bundle.js"></script>
<!-- <script src="../assets/dist/js/notifications/sweetalert2/sweetalert2.bundle.js"></script> -->

<?php //require_once 'ckeditor.inc.php'; ?>

<script>
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    var activeParam = getParameterByName('active');

    if (activeParam) {
        var element = document.getElementById(activeParam);
        if (element) {
            element.classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var titleMappings = {
            'main': 'หน้าแรก',
            'report': 'รายงานผลการเรียน',
            'course': 'คอร์สเรียน',
            'lesson': 'บทเรียน',
            'quiz': 'แบบทดสอบ',
            'exe': 'แบบฝึกหัด',
            'class_room': 'ห้องเรียน',
            'account': 'บัญชีผู้ใช้งาน',
            'student': 'นักเรียน',
            'member': 'สมาชิก',
            'press_release': 'ประชาสัมพันธ์',
            'recommend': 'แนะนำคอร์สเรียน',
            'new_registration': 'คำร้องขอลงทะเบียนใหม่',
            'new_password': 'คำร้องขอรหัสผ่านใหม่',
            'web_settings': 'การตั้งค่าเว็บไซต์',
            'default': 'error: Title'
        };

        function setActiveMenuItem(menuItemId) {
            var menuItem = document.getElementById(menuItemId);
            if (menuItem) {
                menuItem.classList.add('active');
            }
        }

        setActiveMenuItem(activeParam);

        if (activeParam === 'student' || activeParam === 'member') {
            setActiveMenuItem('account');
            setActiveMenuItem(activeParam);
        }

        var showTitle = titleMappings[activeParam] || titleMappings['default'];
        showTitle += ' | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์';

        document.title = showTitle;
    });
</script>

<!-- ckeditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/super-build/ckeditor.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="editor"]').forEach(textarea => {
            CKEditorInit(textarea);
        });
    });

    function CKEditorInit(textarea) {
        CKEDITOR.ClassicEditor.create(textarea, {
            toolbar: {
                items: [
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat'
                    , '|' , 'bulletedList', 'numberedList', 'todoList'
                    , '|' , 'outdent', 'indent'
                    , '|' , 'highlight'
                    , '|' , 'alignment'
                    , '|' , 'specialCharacters'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: '',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType'
            ]
        });
    }

</script>



