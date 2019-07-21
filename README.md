# Segitztherme

# Getting started

1. Install Git (2.22.0): https://git-scm.com/downloads
2. Install Node.js (10.16.0): https://nodejs.org/en/
3. Run `git clone https://github.com/tobias-ziegler/segitztherme.git`
4. Run `npm install -g @angular/cli`
5. Run `npm install -g gulp-cli`
6. Run `npm install` within st-web/app
7. Place your xampp folder in the root directory of the cloned repo
8. Execute `setup_xampp.bat`
9. Start Apache in XAMPP control center
10. Run `ng build --prod` within st-web/app
11. Run `npm run deploy` within st-web/app
12. Check out http://localhost:80/st-web to see if it works

# Git Workflow

See https://miro.medium.com/max/700/1*uUpzVOpdFw5V-tJ_YvgFmA.png
and https://git-scm.com/docs

## Creating a branch

Run `git checkout -b <branch_name> develop`

## Checking out a branch

Run `git checkout <branch_name>`

## Pushing your branch to origin

Run `git push -u origin <branch_name>`

## Pulling changes from origin

Run `git pull`

## Commiting your code

Run `git commit -m "commit message goes here"`

## Pushing your code to origin

Run `git push`

## Typical workflow

1. Pull changes
2. Create a feature branch locally (from develop)
3. Push your branch to GitHub
4. Commit and push your code
5. Merge develop into your branch
6. Create a pull request on GitHub and set the destination to develop. Never push your code directly to master or develop.

# Backend

## Apache

Start Apache in your XAMPP control center and navigate to `http://localhost:80/st-web`.

## Deployment

Run `npm run deploy` within `st-web/app` to deploy both API and the web app to Apache.

## Scripts

You can also choose to deploy the API and the web app separately. See `gruntfile.json` for more scripts.

## Hint

Install Postman for easy API testing.

# Frontend
This project was generated with [Angular CLI](https://github.com/angular/angular-cli) version 8.1.2.

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory. Use the `--prod` flag for a production build.

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via [Protractor](http://www.protractortest.org/).

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI README](https://github.com/angular/angular-cli/blob/master/README.md).

