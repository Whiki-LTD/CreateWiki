<?php

namespace Miraheze\CreateWiki\Notifications;

use MediaWiki\Extension\Notifications\DiscussionParser;
use MediaWiki\Extension\Notifications\Formatters\EchoEventPresentationModel;
use MediaWiki\Language\RawMessage;

class EchoRequestDeclinedPresentationModel extends EchoEventPresentationModel {
	public function getIconType() {
		return 'request-declined';
	}

	public function getHeaderMessage() {
		return $this->msg( 'notification-header-request-declined' );
	}

	public function getBodyMessage() {
		$reason = $this->event->getExtraParam( 'reason' );
		$text = DiscussionParser::getTextSnippet( $reason, $this->language );

		return new RawMessage( "$1", [ $text ] );
	}

	public function getPrimaryLink() {
		return false;
	}

	public function getSecondaryLinks() {
		$visitLink = [
			'url' => $this->event->getExtraParam( 'request-url', 0 ),
			'label' => $this->msg( 'notification-createwiki-visit-request' )->text(),
			'prioritized' => true,
		];

		return [ $visitLink ];
	}
}
