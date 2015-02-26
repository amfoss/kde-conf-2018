# kdeconf
The website is published in `amfoss.github.io/kdeconf/`

Please note that all patches should be sent via the project gerrit hosted at 'Gerrithub

To submit a patch:

Clone the gerritrepo to anywhere in your system
```bash
git clone https://review.gerrithub.io/amfoss/kdeconf
```
Enter the cloned folder
```bash
cd kdeconf
```
Create a new branch with a sensible name to work upon. Eg: 
```bash
git checkout -b 'newBranc' origin/gh-pages
```
Open `index.html` in your favourite browser

Make your changes, find issues from `https://github.com/amfoss/kdeconf/issues`

Once you are done with the change, you should push the changes to the Gerrit for code-review:
You can do that by 
```bash
git add --all
git commit
``` 
Enter your commit message, which should clearly show what you did in the change

```bash 
git review
``` 

Wait for your code-review and changes to be published in `amfoss.github.io/kdeconf/`
