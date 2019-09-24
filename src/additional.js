const PROTOCOL = window.location.protocol
const HOST = window.location.host
const PATH = HOST === 'localhost' ? 'sips/' : ''
const BASE_URL = `${PROTOCOL}//${HOST}/${PATH}`
const TOKEN = sessionStorage.getItem('SIPS-KEY')
const USERNAME = 'sips-codemaniac'
const PASSWORD = 'codemaniac123'