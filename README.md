# php-task

First attempt at PHP language. Had a great learning experience. The front end side leaves a lot to be desired, but that was not the focus of this task. Had to rethink/remake the database structure a few times. I'd say most of the pages were easy apart from the "edit_project.php" page, because it required the most database logic. As I come from Python at first I used Python PEP-8 rules, halfway into the project I tried to use the PSR guidelines.

1. On first visit a teacher should create a new project by providing a title of the project and
a number of groups that will participate in the project and a maximum number of
students per group. Groups should be automatically initialized when a project is created.
2. If the project exists, a teacher can add students using the “Add new student” button.
Each student must have a unique full name.
3. All students are visible on a list.
4. Teacher can delete a student. In such a case, the student should be removed from the
group and project.
5. Teacher can assign a student to any of the groups. Any student can only be assigned to
a single group. In case the group is full, information text should be visible to a teacher.
