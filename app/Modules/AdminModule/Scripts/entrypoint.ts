import "../../../../node_modules/jquery/dist/jquery"
import "../../../../node_modules/naja/dist/Naja"
//import netteForms from "../../../../node_modules/nette-forms/src/assets/netteForms"
import netteForms from 'nette-forms'
window.Nette = netteForms
naja.initialize()
naja.formsHandler.netteForms = window.Nette

import 'bootstrap'
import "ublaboo-datagrid"

import './layout/topbar'
import './layout/spinner'
import './layout/sidebar'
import './layout/toast'


