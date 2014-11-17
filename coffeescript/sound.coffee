# My own util codes
#
# Description:
#   functions for sound programm.
#
# Author:
#   sota1235
#
# Functions:
#   WA_init() : Return instance of Audio Context (Web Auido API)

# Web Audio API
WA_init = (callback = ->) ->
  try
    AudioContext = window.AudioContext || window.webkitAudioContext
    context = new AudioContext()
    callback null, context
  catch e
    callback 'Web Audio API is not supported in this browser'
