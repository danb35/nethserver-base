<?php
namespace NethServer\Module\Pki;
/*
 * Copyright (C) 2014  Nethesis S.r.l.
 *
 * This script is part of NethServer.
 *
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * TODO: add component description here
 *
 * @author Davide Principi <davide.principi@nethesis.it>
 * @since 1.6
 */
class Show extends \Nethgui\Controller\AbstractController
{

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);

        $view['x509text'] = $this->getX509text();
        $view['GenerateLink'] = $view->getModuleUrl('../Generate');
        
    }

    private function getX509text() {
        $certFile = $this->getPlatform()->getDatabase('configuration')->getProp('pki', 'CertFile');
        if( ! $certFile) {
            $certFile = "/etc/pki/tls/certs/NSRV.crt";
        }
        return $this->getPlatform()->exec('/usr/bin/sudo /usr/libexec/nethserver/pki-info -s ${@}', array($certFile))->getOutput();
    }

}