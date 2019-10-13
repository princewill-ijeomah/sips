const PROTOCOL = window.location.protocol
const HOST = window.location.host
const PATH = HOST === 'localhost' ? 'sips/' : ''
const BASE_URL = `${PROTOCOL}//${HOST}/${PATH}`
const INT_TOKEN = localStorage.getItem('INT-SIPS-KEY')
const EXT_TOKEN = localStorage.getItem('EXT-SIPS-KEY')
const USERNAME = 'sips-codemaniac'
const PASSWORD = 'codemaniac123'