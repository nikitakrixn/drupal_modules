<?php


namespace Drupal\discount_code\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use False\True;

/**
 * Defines the DiscountCode entity.
 *
 * @ingroup discount_code
 *
 * @ContentEntityType(
 *   id = "discount_code",
 *   label = @Translation("Discount Code"),
 *   base_table = "discount_code",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "code" = "string",
 *   },
 * )
 */

class DiscountCodeEntity extends ContentEntityBase implements ContentEntityInterface {

  /**
   * Creating the basic structure for the entity
   * Provides base field definitions for the entity type.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   * @return array|\Drupal\Core\Field\FieldDefinitionInterface[]|mixed
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Discount Code entity.'))
      ->setReadOnly(TRUE);

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Discount Code entity.'))
      ->setReadOnly(TRUE);

    $fields['code'] = BaseFieldDefinition::create('string')
      ->setLabel(t('CODE'))
      ->setDescription(t('The Code of the DiscountCode entity.'))
      ->setReadOnly(TRUE);

    return $fields;
  }
}
