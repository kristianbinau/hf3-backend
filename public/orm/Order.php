<?php

class Order extends AbstractOrm
{
    protected static string $table = 'orders';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->orderItems = OrderItem::retrieveByField('order_id', $this->id);
        $this->orderDiscounts = OrderDiscount::retrieveByField('order_id', $this->id);
        $this->orderDeliveries = OrderDelivery::retrieveByField('order_id', $this->id, self::FETCH_ONE);
    }
}
