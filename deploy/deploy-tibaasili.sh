#!/bin/bash
 git tag -d production
 git push --delete origin tag production
 git tag production
 git push origin tag production
 git tag -d production
