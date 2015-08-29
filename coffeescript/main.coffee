# main.coffee
#
# Description:
#   All of util functions
#
# Author:
#   @sota1235

class Util
  rjust: (string, count, fill = ' ') ->
    new Array(count).join(fill) + string

  ljust: (string, count, fill = ' ') ->
    string + new Array(count).join(fill)
