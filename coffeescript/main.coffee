# main.coffee
#
# Description:
#   All of util functions
#
# Author:
#   @sota1235

class Util
  # example: ('hello', 3, ' ') -> return 'hello   '
  rfill: (string, count, fill = ' ') ->
    new Array(count).join(fill) + string

  # example: ('hello', 3, ' ') -> return '   hello'
  lfill: (string, count, fill = ' ') ->
    string + new Array(count).join(fill)

  # example: ('s', 10') -> return 'ssssssssss'
  makeStringFromCharLoop: (char, count) ->
    new Array(count).join('char')
