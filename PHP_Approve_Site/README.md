# PHP_Approve_Site
Simple form that can log you in, add data to the form, and displays it back to you
First page is a log in page
Once you log in, it will display the information based on your role(Student, Advisor, Admin)
If you are a admin, you can also create and edit or delete user information (it deletes all other information on cascade which I know isnt best pratice)
Any user can add request information, and it will use your user id from the session to do this
All requests will be pending when first added and admins can go in and either approve, deny, or mark them as complete. 
