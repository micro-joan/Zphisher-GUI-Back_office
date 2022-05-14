![Logo back-office](https://user-images.githubusercontent.com/55983491/168439069-3ad07988-0275-4107-9b7d-0b4698c6550a.png)

# Zphisher-GUI-Back_office

This is a plugin where you can see in real time the victims of your phishing campaign, you just have to change the Zphisher files for these. Easy!

## Instructions

- You need to deploy the server with a template, identify in the "login.html" file the name of the two post parameters.
- Modify the post parameters of the "login.php" file of the plugin with the original identifier of Zphisher (line 7 and 8).
- Replace all deployed http server files with plugin files (except login.html).

If you have an api key from haveibeenpwned.com you have to insert it in the file "api_key.txt" in the directory "programa interprete", in this way the back-office will tell you which accounts are exposed on the internet.

## No need 100% Zphisher

You can also use this plugin by hard sharing the project by Ngrok from your LocalHost without using Zphisher.

This plugin comes with a sample login page, in this case from Office 365, you can use any Zphisher template for this plugin, using Ngrok to share your localhost.

## Where are the results saved?

The results will be saved in /interpreter program/user_data.csv

![Untitled Project (3)](https://user-images.githubusercontent.com/55983491/168440829-1b140cf7-3ede-428e-b2ad-a89cd3468455.gif)

## Back office properties

-You can see if the inserted account is exposed on the internet:
![image](https://user-images.githubusercontent.com/55983491/168440897-6e70af86-a744-4776-a9de-3c54439a730d.png)

-Total number of accounts and "Pwned" accounts:
![image](https://user-images.githubusercontent.com/55983491/168440952-a4453be2-97df-4bf1-953d-7e00ad40d519.png)

-Evaluation of security in the passwords of all the inserted accounts:
![image](https://user-images.githubusercontent.com/55983491/168440970-7fdd6df1-decc-4a6c-97c4-bd06b51a65e2.png)




