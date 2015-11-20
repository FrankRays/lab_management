# Contributing to AMS


Issues are a quick way to point out a bug. If you find a bug or documentation error in AMS then please check a few things first:

1. There is not already an open Issue
2. The issue has already been fixed (check the develop branch, or look for closed Issues)
3. Is it something really obvious that you can fix yourself?

Reporting issues is helpful but an even better approach is to send a Pull Request, which is done by "Forking" the main repository and committing to your own copy. This will require you to use the version control system called Git.

## Guidelines

Before we look into how, here are the guidelines. If your Pull Requests fail
to pass these guidelines it will be declined and you will need to re-submit
when you’ve made the changes. This might sound a bit tough, but it is required
for us to maintain quality of the code-base.

### PHP Style

Code should be well commented in a documentation format, should use tab instead of spaces for indentation. Failure to meet these criteria will result in decline of pull request.

### Documentation

Now there's no proper documentation, we'd like to create one.

### Compatibility

Use latest PHP as far as possible

### Branching

AMS uses the branching model where all pull requests is to be sent to the "dev" branch. The "master" branch will contain the latest working application and is kept clean.


## How-to Guide

1. Set up Git (Linux or MAC [Please don't use windows])
2. Go to the AMS repo
3. Fork it
4. Clone your AMS repo: git@github.com:<your-name>/ams.git
5. Checkout the "dev" branch.
6. Make the changes
7. Commit the files
8. Push your "dev" branch to your fork
9. Send a pull request

We can't promise every pull request you send will be merged, but it helps in a way and is definitely a good sign.

### Keeping your repository up to date.

On your root of AMS repo on your machine, execute the following commands

1. `git remote add ams git://github.com/[your user_name]/ams.git`
2. `git pull ams dev`
3. `git push origin dev`

You should do this every time you start working on AMS